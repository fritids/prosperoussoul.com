<?php	 	 
/*
Plugin Name: Shopp Google XML Sitemap
Plugin URI: http://www.mygeeknc.com/shopp-toolbox
Description: Shopp & Google XML Sitemap Integration. This plugin is part of the <a href="http://www.mygeeknc.com/shopp-toolbox/">Shopp Toolbox</a>.
Version: 1.0.6
Author: MyGeek Computer Services
Author URI: http://www.mygeeknc.com
*/

if(!defined('ABSPATH')) die();

$ShoppSiteMap = new ShoppSiteMap();

class ShoppSiteMap{
	var $version = '1.0.6';
	var $product = 'shoppgooglexmlsitemap';
	var $basename;
	
	function __construct(){
		$this->basename = plugin_basename(__FILE__);

		$this->updater();

		add_action('admin_menu', array(&$this, 'add_menu'), 99);
		add_action('sm_buildmap', array(&$this, 'add_urls'));
		add_action('admin_notices', array(&$this, 'notices'));
		add_action('init', array(&$this, 'updater'), 99);

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
			$page = add_submenu_page('shopp-toolbox', 'Shopp Toolbox', 'Get Started', 'shopp_menu', 'shopp-toolbox', array(&$this, 'display_welcome'));
	        add_action( 'admin_print_styles-'.$page, array(&$this, 'load_css'));
		}

		$page = add_submenu_page('shopp-toolbox', 'Google XML Sitemaps', 'Google XML Sitemaps', 'shopp_menu', 'shopp-google-xml-sitemaps', array(&$this, 'display_settings'));
        add_action( 'admin_print_styles-'.$page, array(&$this, 'load_css'));

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

	function updater(){
		if(!class_exists('ToolboxUpdater')){
			require_once(dirname(__FILE__).'/lib/Update.php');
		}
	}
	function display_settings(){
		echo "There are no settings for this plugin currently.";
	}

	function notices(){
		if(!is_plugin_active('shopp/Shopp.php')){
			echo '<div class="error"><p><strong>Shopp Google XML Sitemap</strong>: It is highly recommended to have the <a href="http://www.shopplugin.net">Shopp Plugin</a> active before using any of the Shopp Toolbox plugins.</p></div>';
		}

		if(!is_plugin_active('google-sitemap-generator/sitemap.php')){
			echo '<div class="error"><p><strong>Shopp Google XML Sitemap</strong>: It is highly recommended to have the <a href="http://wordpress.org/extend/plugins/google-sitemap-generator/">Google XML Sitemaps</a> plugin active before using this Shopp Toolbox plugin.</p></div>';
		}
	}

	function load_products(){
		global $wpdb;
		if(version_compare(SHOPP_VERSION, '1.2RC1') >= 0){
			return $wpdb->get_results("SELECT id FROM ".$wpdb->posts." WHERE post_type = 'shopp_product' AND post_status = 'publish'");
		}else{
			return $wpdb->get_results("SELECT id, slug, modified FROM ".$wpdb->prefix."shopp_product WHERE status = 'publish'");
		}
	}

	function add_urls(){
		$gsm = &GoogleSitemapGenerator::GetInstance();
				
		if(!is_null($gsm)){
			$products = $this->load_products();

			foreach ($products as $product) {
				if(version_compare(SHOPP_VERSION, '1.2RC1') >= 0){
					$p = shopp_product($product->id);
					$uri = shoppurl(SHOPP_PRETTYURLS?$p->slug:array('shopp_product'=>$p->slug));
					$gsm->AddUrl($uri, $p->modified, 'weekly', '0.6');
					unset($p);
				}else{
					$uri = shoppurl(SHOPP_PRETTYURLS?$product->slug:array('shopp_pid'=>$product->id));
					$gsm->AddUrl($uri, strtotime($product->modified), 'weekly', '0.6');
				}


			}
		}
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
}
