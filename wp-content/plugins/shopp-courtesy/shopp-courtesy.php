<?php	 	 
/*
Plugin Name: Shopp Courtesy Followup
Version: 1.2.5
Description: Simply sends a courtesy email after a predefined number of days to each customer after a successful order. This plugin is part of the <a href="http://www.mygeeknc.com/shopp-toolbox/">Shopp Toolbox</a>
Plugin URI: http://www.mygeeknc.com/shopp-toolbox
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
if(!defined('ABSPATH')) die();

$ShoppCourtesy = new ShoppCourtesy();

class ShoppCourtesy{
	var $version = '1.2.5';
	var $product = 'shoppcourtesy';
	var $basename;

	function __construct(){
		$this->basename = plugin_basename(__FILE__);

		$this->updater();

		register_activation_hook(__FILE__, array(&$this, 'on_activation'));
		register_deactivation_hook(__FILE__, array(&$this, 'on_deactivation'));

		add_action('admin_menu', array(&$this, 'add_menu'), 99);	
		add_action('shopp_courtesy', array(&$this, 'send_email'));
		add_action('init', array(&$this, 'updater'), 99);
		add_action('admin_notices', array(&$this, 'notices'));

		//To register our CSS file to load later.
        add_action('admin_init', array(&$this, 'register_css'));
        add_action('admin_head', array(&$this, 'load_tinymce'));

        if(is_admin()){
        	wp_enqueue_script(array('jquery', 'editor', 'thickbox', 'media-upload'));
        	wp_enqueue_style('thickbox');
        }

        //For updates
        $update_args = array(
        	'version' => $this->version,
        	'basename' => $this->basename,
        	'product' => $this->product
	        );
        new ToolboxUpdater($update_args);
	}

	function notices(){
		if(!is_plugin_active('shopp/Shopp.php')){
			echo '<div class="error"><p><strong>Shopp Courtesy</strong>: It is highly recommended to have the <a href="http://www.shopplugin.net">Shopp Plugin</a> active before using any of the Shopp Toolbox plugins.</p></div>';
		}
	}

	function register_css(){
		wp_register_style('stb-courtesy-css', plugins_url('css/stb-courtesy-admin.css', __FILE__));
	}

    function load_css(){
        wp_enqueue_style('stb-courtesy-css');
    }

    function load_tinymce(){
    	wp_tiny_mce(false);
    }

	function on_activation(){
		//Check settings
		if(!get_option('shopp_courtesy')){
	        $default_settings = array(
	        	'version' => $this->version,
	            'days' => '',
	            'subject' => '',
	            'message' => ''
	            );
       		add_option('shopp_courtesy', $default_settings, '', 'no');
    	}

    	//Run upgrade
		$this->do_upgrade();
				
		wp_schedule_event(mktime(24, 0, 0, date('n', time()), date('j', time()), date('Y', time())), 'daily', 'shopp_courtesy');
	}

	function on_deactivation(){
		wp_clear_scheduled_hook("shopp_courtesy");
	}

	function add_menu(){
		if(!$this->toolbox_menu_exist()){
			add_menu_page('Shopp Toolbox', 'Shopp Toolbox', 'shopp_menu', 'shopp-toolbox', array(&$this, 'display_welcome'), plugin_dir_url(__FILE__) . 'img/toolbox.png', 56);
			$page = add_submenu_page('shopp-toolbox', 'Shopp Toolbox', 'Get Started', 'shopp_menu', 'shopp-toolbox', array(&$this, 'display_welcome'));
	        add_action( 'admin_print_styles-'.$page, array(&$this, 'load_css'));
		}

		$page = add_submenu_page('shopp-toolbox', 'Courtesy Followup', 'Courtesy Followup', 'shopp_menu', 'shopp-courtesy', array(&$this, 'display_settings'));
        add_action( 'admin_print_styles-'.$page, array(&$this, 'load_css'));
        add_meta_box('stb_courtesy_save', 'Save', array(&$this, 'display_save_meta'), $page, 'side', 'default');
        add_meta_box('stb_courtesy_dynamic', 'Dynamic Variables', array(&$this, 'display_dynamic_info'), $page, 'side', 'low');

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

	function do_upgrade(){
		//Update version number
		if(get_option('shopp_courtesy')){
			$options = get_option('shopp_courtesy');
			$option['version'] = $this->version;
			update_option('shopp_courtesy', $options);	
		}
	
		//Upgrade from 1.0.0 to 1.1.0		
		if(get_option('shoppc_days')){
			//Migrate Setings
			$settings = array();
			$settings['version'] = $this->version;

			if(get_option('shoppc_days')){
				$settings['days'] = get_option('shoppc_days');
				delete_option('shoppc_days');
			}

			if(get_option('shoppc_subject')){
				$settings['subject'] = get_option('shoppc_subject');
				delete_option('shoppc_subject');
			}

			if(get_option('shoppc_message')){
				$settings['message'] = get_option('shoppc_message');
				delete_option('shoppc_message');
			}

			update_option('shopp_courtesy', $settings);
		}
	}

	function updater(){
		if(!class_exists('ToolboxUpdater')){
			require_once(dirname(__FILE__).'/lib/Update.php');
		}
	}

	function send_email($email = ''){
		global $wpdb;
		$options = get_option('shopp_courtesy');
		
		if(empty($email)){
			$date = date('Y-m-d', strtotime("-". $options['days'] ."days"));
			$r = $wpdb->get_results("SELECT id, firstname, lastname, company, email FROM ".$wpdb->prefix."shopp_purchase WHERE created LIKE '%".$date."%'");
		}else{
			$current_user = wp_get_current_user();

			$r = new stdClass;
			$r->test = new stdClass;
			$r->test->firstname = $current_user->user_firstname;
			$r->test->lastname = $current_user->user_lastname;
			$r->test->id = '1';
			$r->test->email = sanitize_email($email);
		}

		$raw_content = htmlspecialchars_decode(html_entity_decode(stripslashes($options['message'])));
		$content = '';
		
		//send notification email
		$headers = 'From: '. get_bloginfo('name') . ' <'.get_bloginfo('admin_email').'>' . "\r\n\\";
		add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
		
		foreach($r as $id => $order){
			$content = str_replace('::first_name::', $order->firstname, $raw_content);
			$content = str_replace('::last_name::', $order->lastname, $content);
			$content = str_replace('::company::', $order->company, $content);
			$content = str_replace('::order_num::', $order->id, $content);

			$result = wp_mail($order->email, $options['subject'], $content, $headers);
		}
	}

	function display_welcome(){
		$License = new ToolboxUpdater();
		$license_key = $License->get_license_key();

		if(isset($_REQUEST['save_license']) && wp_verify_nonce($_REQUEST['stb_welcome_nonce'], 'nonce_save_license') && !empty($_REQUEST['license_key'])){
			$results = $License->activate_key($_REQUEST['license_key']);
			if($results->status != '0'){
					echo '<div class="error"><p>'.$results->message.'</p></div>';
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
                                        <?php if(empty($license_key)): ?>

                                            <p><span class="description ">License Key: </span> <input type="text" size="35" name="license_key" value="" /> <input type="submit" class="button-primary" value="Activate" /></p>
                                            <input type="hidden" name="save_license" value="true" />

                                        <?php else: ?>

                                            <p><span class="description ">License Key: </span> <input type="password" size="35" name="license_key" value="<?php echo $license_key; ?>" /> <input type="submit" class="button-secondary" value="Deactivate" /></p>
                                            <input type="hidden" name="save_license" value="true" />
                                        <?php endif; ?>

                                        <?php wp_nonce_field('nonce_save_license', 'stb_welcome_nonce'); ?>
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

	function display_save_meta(){
		$options = get_option('shopp_courtesy');
		$current_user = wp_get_current_user();

?>
		<p>
			<label>Wait how many days?</label>
			<select name="settings[days]">
				<option value="1"></option>
				<?php	 	  
					$list = range(1, 15);
					echo menuoptions($list, $options['days'], false, false); 
				?>
			</select>
		</p>
		<p>
			<input type="checkbox" name="send_test_email" value="true" />Send a test email to me
			<input type="email" name="email" value="<?php echo (isset($current_user->user_email) ? $current_user->user_email : '') ?>">

		</p>
		<input type="hidden" name="save_settings" value="true" />
		<input type="submit" class="button-primary" value="Save Settings" name="submit" />
<?php	 	 
	}

	function display_dynamic_info(){
?>
		<p>
			Use the following variables to generate dynamic content within the email.
		</p>

		<ul>
			<li><b>First Name</b> - ::first_name::</li>
			<li><b>Last Name</b> - ::last_name::</li>
			<li><b>Company</b> - ::company::</li>
			<li><b>Order Number</b> - ::order_num::</li>
		</ul>
<?php
	}

	function display_settings(){
		$options = get_option('shopp_courtesy');

		if(isset($_REQUEST['save_settings']) && wp_verify_nonce($_REQUEST['stb_courtesy_nonce'], 'nonce_save_settings')){

			$options['days'] = absint($_REQUEST['settings']['days']);
			$options['subject'] = esc_attr($_REQUEST['settings']['subject']);
			$options['message'] = $_REQUEST['message'];

			$return = update_option('shopp_courtesy', $options);

			if(isset($_REQUEST['send_test_email'])){
				$this->send_email($_REQUEST['email']);
			}

			if($return){
				echo '<div class="updated"><p>Your settings have been saved.</p></div>';
			}else{
				echo '<div class="error"><p>Saving your settings has failed or you didn\'t change anything.</p></div>';
			}
		}
?>	
		<div id="shopp_courtesy" class="wrap">
	        <h2>Shopp Courtesy</h2>
	        <div class="description">
	            <p>This plugin enables Shopp to dispatch a "courtesy" email to your customers X number of days after an order is complete. This is useful for things like follow up emails, product promotions, etc.</p>
	        </div>
			<form action="" method="post">
              		<div id="poststuff" class="metabox-holder has-right-sidebar">
              			<div id="side-info-column" class="inner-sidebar">
							<?php do_meta_boxes('shopp-toolbox_page_shopp-courtesy', 'side', null); ?>
						</div>

						<div id="post-body" class="has-sidebar">
						<div id="post-body-content" class="has-sidebar-content">
							<div id="titlediv">
								<div id="titlewrap">
									<input name="settings[subject]" id="title" type="text" value="<?php echo esc_attr($options['subject']); ?>" size="30" tabindex="1" autocomplete="off" />
								</div>
								<div class="inside">
									<?php the_editor(stripslashes($options['message']), 'message', '', false, 3, true); ?>
								</div>
							</div>
						</div>
						</div>

					</div>
                <?php wp_nonce_field('nonce_save_settings', 'stb_courtesy_nonce'); ?>
		    </form>
	    </div>
<?php	 	 	
	}
}