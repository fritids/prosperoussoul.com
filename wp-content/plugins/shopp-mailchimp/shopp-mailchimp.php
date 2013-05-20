<?php	 	 
/*
Plugin Name: Shopp MailChimp
Version: 1.0.6
Description: This plugin gives a very basic MailChimp/Shopp integration. This plugin is part of the <a href="http://www.mygeeknc.com/shopp-toolbox/">Shopp Toolbox</a>
Plugin URI: http://www.mygeeknc.com/shopp
Author: MyGeek Computer Services
Author URI: http://www.mygeeknc.com

	This plugin is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This plugin is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this plugin.  If not, see <http://www.gnu.org/licenses/>. 
*/
$ShoppMailChimp = new ShoppMailChimp();	

class ShoppMailChimp{
	var $version = '1.0.6';
	var $product = 'shoppmailchimp';
	var $basename;
	
	function __construct(){
		$this->basename = plugin_basename(__FILE__);

		$this->updater();
		
		register_activation_hook(__FILE__, array(&$this, 'on_activation'));

		add_action('init', array(&$this, 'mailchimp_class'), 99);
		add_action('admin_menu', array(&$this, 'add_menu'), 99);	
		add_action('shopp_order_success', array(&$this, 'subscribeToML'));
		add_action('admin_notices', array(&$this, 'notices'));


		$this->api_key = get_option("scm_api");
		$this->listid = get_option("scm_listid");

		//For updates
        $update_args = array(
        	'version' => $this->version,
        	'basename' => $this->basename,
        	'product' => $this->product
	        );
        new ToolboxUpdater($update_args);
	}

	function add_menu(){
		global $menu;
		$position = 52;
		while (isset($menu[$position])) $position++;

		if(!$this->toolbox_menu_exist()){
			add_menu_page('Shopp Toolbox', 'Shopp Toolbox', 'shopp_menu', 'shopp-toolbox', array(&$this, 'display_welcome'), plugin_dir_url(__FILE__) . 'img/toolbox.png', $position);
			add_submenu_page('shopp-toolbox', 'Shopp Toolbox', 'Get Started', 'shopp_menu', 'shopp-toolbox', array(&$this, 'display_welcome'));
		}

		add_submenu_page('shopp-toolbox', 'MailChimp Integration', 'MailChimp Integration', 'shopp_menu', 'shopp-mailchimp', array(&$this, 'display_settings'));
	}

	function notices(){
		if(!is_plugin_active('shopp/Shopp.php')){
			echo '<div class="error"><p><strong>Shopp MailChimp</strong>: It is highly recommended to have the <a href="http://www.shopplugin.net">Shopp Plugin</a> active before using any of the Shopp Toolbox plugins.</p></div>';
		}
	}

	function updater(){
		if(!class_exists('ToolboxUpdater')){
			require_once(dirname(__FILE__).'/lib/Update.php');
		}
	}

	function mailchimp_class(){
		if(!class_exists('MCAPI')){
			require_once('lib/MCAPI.class.php');
		}
	}

	function on_activation(){
		$this->do_upgrade();
	}

	function do_upgrade(){
		$options = get_option('stb-mailchimp');

		if(get_option('scm_api')){
			$options['api_key'] = get_option('scm_api');
			delete_option('scm_api');
		}

		if(get_option('scm_listid')){
			$options['listid'] = get_option('scm_listid');
			delete_option('scm_listid');
		}

		update_option('stb-mailchimp', $options);
	}

	function subscribeToML($Purchase){
		$options = get_option('stb-mailchimp');

		if(function_exists('shopp_customer_marketing')){
			$Purchase = shopp_customer();
			$marketing = shopp_customer_marketing($Purchase->id);
		}else{
			global $wpdb;
			$table = $wpdb->prefix . "shopp_customer";
			$marketing = $wpdb->get_var($wpdb->prepare("SELECT marketing FROM $table WHERE id = %s", $Purchase->customer));
		}

		if($this->value_is_true($marketing)){
			$a = new MCAPI($options['api_key']);
			$a->listSubscribe($options['listid'], $Purchase->email, array('FNAME'=>$Purchase->firstname,'LNAME'=>$Purchase->lastname), 'html', 'false', 'true');
		}
	}

	function toolbox_menu_exist(){
		global $menu;

		$return = false;
		foreach($menu as $menus => $item){
            if($item[0] == 'Shopp Toolbox'){
				$return = true;
			}
		}

		return $return;
	}

	function display_settings(){
		$options = get_option('stb-mailchimp');

		if(isset($_REQUEST['save_settings']) && wp_verify_nonce($_REQUEST['nonce_save_settings'], 'stb_mailchimp_nonce')){
			$options['api_key'] = esc_attr($_REQUEST['api']);
			$options['listid'] = esc_attr($_REQUEST['listid']);
			update_option('stb-mailchimp', $options);
				
			echo '<div class="updated"><p>Your settings have been saved.</p></div>';
		}
?>
		<div class="wrap">
	        <h2>Shopp MailChimp</h2>
	        <div class="description">
	            <p>This plugin enables Shopp to pass the customer's email address to MailChimp if the customer decides they wish to participate in e-mail marketing during the checkout process (the marketing checkbox on the checkout page). A cusomter's email address will only be passed if the order is successfully charged.</p>
	        </div>
			<form action="" method="post">
			        <div class="metabox-holder">
				        <div id="shopp-mailchimp" class="postbox">
				            <div class="handlediv" title="Click to toggle">
				                <br />
				            </div>
				            <h3 class="hndle"><span>General Settings</span></h3>
				            <div class="inside">
				            	<p>
					                <ul>
					                	<li><strong>MailChimp API Key:</strong> <input type="text" name="api"  size="35" value="<?php echo esc_attr($options['api_key']); ?>" /> <a target = "_blank" href="https://us1.admin.mailchimp.com/account/api/">(MailChimp API)</a></li>
					                	<li><strong>MailChimp List ID:</strong> <input type="text" name="listid"  size="35" value="<?php echo esc_attr($options['listid']); ?>" /> <a target = "_blank" href="https://us1.admin.mailchimp.com/lists/">(Hover over "Settings" then click "list settings and unique ID". Your List ID will be at the bottom of the page)</a></li>
					                </ul>
				                </p>
				            </div> <!--inside-->
				        </div><!--postbox-->
				    </div><!--metabox-holder-->
				 <?php wp_nonce_field('stb_mailchimp_nonce', 'nonce_save_settings'); ?>
                <input type="hidden" name="save_settings" value="true" />	
				<input type="submit" class="button-primary" value="Save Settings" name="submit" />
		    </form>
	    </div>
<?php	 	 	
	}	

	function display_welcome(){
		$License = new ToolboxUpdater();
		$license_key = $License->get_license_key();

		if(isset($_REQUEST['save_license']) && wp_verify_nonce($_REQUEST['stb_welcome_nonce'], 'nonce_save_license') && !empty($_REQUEST['license_key'])){
			$results = $License->activate_key($_REQUEST['license_key']);
			if($results->status != '0'){
					echo '<div class="error">'.$results->message.'</div>';
			}else{
				echo '<div class="updated">Your license key is now activated for this site.</div>';
				$license_key = esc_attr($_REQUEST['license_key']);
			}
		}
?>
		<div id="stb-welcome" class="wrap">
				<h2>Get Started with the Shopp Toolbox</h2>
		        <div  class="metabox-holder">
			        <div  class="postbox">
			            <div class="handlediv" title="Click to toggle">
			                <br />
			            </div>
			            <h3 class="hndle"><span>Thank You</span></h3>
			            <div class="inside">
			            	<p class="description">
			            		I wanted to start out with just a thank you. Thank you for supporting the Shopp Toolbox. We strive to produce useful and stable add-ons for the Shopp e-commerce plugin. If we can make your store just a tad easier to manage or if we can fill a gap that Shopp doesn't do on it's own, then we've done our job. If you ever experience any issues with our plugins, please let us know. We will fix your issues. 
				            </p>
			            </div> <!--inside-->
			        </div><!--postbox-->
			    </div><!--metabox-holder-->
		        <div class="metabox-holder">
			        <div id="shopp_courtesy" class="postbox">
			            <div class="handlediv" title="Click to toggle">
			                <br />
			            </div>
			            <h3 class="hndle"><span>Support</span></h3>
			            <div class="inside">
			            	<p class="description">
			            		Please enter your license key in the form below. If your license is not activated on this site. We can not support it. Thank you. <strong>Note that once you've activated your license for one plugin, you don't need to activate it for any other plugin on this same site.</strong>
				            </p>
				            <form action="" method="post">
				            	<ul>
				            		<li>

				            				<p><span class="description ">License Key: </span> <input type="text" size="35" name="license_key" value="" /> <input type="submit" class="button-primary" value="Activate" /></p>
							            	<input type="hidden" name="save_license" value="true" />


				            				<input type="hidden" name="save_license" value="true" />

				            		</li>
				            	</ul>
				            </form>
				            <hr />
				            <p class="description">
				            	<strong>For support, please visit <a href="http://www.mygeeknc.com/shopp-toolbox/support">Shopp Toolbox Support</a></strong>
				            </p>
			            </div> <!--inside-->
			        </div><!--postbox-->
			    </div><!--metabox-holder-->
		</div>
<?php	 	 
	}

	/**
	 * Converts natural language text to boolean values
	 *
	 * Used primarily for handling boolean text provided in shopp() tag options.
	 *
	 * @author Jonathan Davis
	 * @since 1.0
	 *
	 * @param string $value The natural language value
	 * @return boolean The boolean value of the provided text
	 **/
	function value_is_true ($value) {
		switch (strtolower($value)) {
			case "yes": case "true": case "1": case "on": return true;
			default: return false;
		}
	}
}

?>