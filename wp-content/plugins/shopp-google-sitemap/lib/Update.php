<?php	 	 
class ToolboxUpdater{
	var $update_url = "http://license.mygeeknc.com";

	function __construct($args = array()){

		extract(wp_parse_args($args));
		$this->version = $version;
		$this->basename = $basename;
		$this->product = $product;
		/****************************************/
		/*
			For testing purposes only.
		*/
		//set_site_transient('update_plugins', null);
		/****************************************/

		add_filter('pre_set_site_transient_update_plugins', array(&$this, 'check_for_updates'));
	}

	function check_for_updates($transient){
		if(!is_admin()){
			return $transient;
		}

		if(empty($transient->checked))
			return $transient;

		if(!$this->get_license_key())
			return $transient;
		
		$args = array(
			'action' => 'check-updates',
			'plugin_name' => $this->basename,
			'product_name' => $this->product,
			'version' => $this->version,
			'license_key' => $this->get_license_key()
		);

		$response = $this->send($args);

		if(false !== $response){
			$transient->response[$this->basename] = $response;
		}

		return $transient;
	}

	function get_license_key(){
		if(!get_option('toolbox_license_key'))
			return false;

		return get_option('toolbox_license_key');
	}

	function set_license_key($license){
		if(!get_option('toolbox_license_key')){
			return update_option('toolbox_license_key', $license);
		}
		return false;
	}

	function activate_key($license = ''){
		$license = (!empty($license) ? $license : $this->get_license_key());
		$args = array(
			'action' => 'activate-license',
			'plugin_name' => $this->basename,
			'license_key' => $license
		);

		$results = $this->send($args);
		
		if($results->status == '0')
			$this->set_license_key($license);
		
		return $results;
	}

	function deactivate_key($license = ''){
		$license = (!empty($license) ? $license : $this->get_license_key());
		$args = array(
			'action' => 'deactivate-license',
			'plugin_name' => $this->basename,
			'license_key' => $license
		);

		$results = $this->send($args);
		
		if($results->status == '0')
			$this->set_license_key($license);
		
		return $results;
	}

	function send($args){
		global $wp_version;

		$request = wp_remote_post($this->update_url, array('body' => $args, 'user-agent' => 'WordPress/'.$wp_version.'; '.get_home_url()));

		if(is_wp_error($request) || wp_remote_retrieve_response_code($request) != 200){
			return false;
		}
		
		$response = unserialize(wp_remote_retrieve_body($request));

		if(is_object($response)){
			return $response;
		}else{
			return false;
		}
	}
}

?>