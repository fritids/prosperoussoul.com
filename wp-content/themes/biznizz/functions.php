<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';

// WooFramework
require_once ($functions_path . 'admin-init.php');			// Framework Init

// Theme specific functionality
require_once ($includes_path . 'theme-options.php'); 		// Options panel settings and custom settings
require_once ($includes_path . 'theme-functions.php'); 		// Custom theme functions
require_once ($includes_path . 'theme-plugins.php');		// Theme specific plugins integrated in a theme
require_once ($includes_path . 'theme-actions.php');		// Theme actions & user defined hooks
require_once ($includes_path . 'theme-comments.php'); 		// Custom comments/pingback loop
require_once ($includes_path . 'theme-js.php');				// Load javascript in wp_head
require_once ($includes_path . 'sidebar-init.php');			// Initialize widgetized areas
require_once ($includes_path . 'theme-widgets.php');		// Theme widgets

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/

//Navigation
add_action('init','register_custom_menus');
function register_custom_menus(){
register_nav_menu('custom_menus',__('Custom Menu'));
}

//Homepage Widget Area
if ( function_exists('register_sidebar') )
    register_sidebar(array(
    	'name' => 'Homepage',
    	'id' => 'homepage',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h5 class="widgettitle">',
        'after_title' => '</h5>',
    ));

//Custom logo should be 16 x16
function custom_logo() {
  echo '<style type="text/css">
    #header-logo  { 
    	background-image: url('.get_bloginfo('template_directory').'/images/admin-logo.png) !important; 
	}
    </style>';
}

add_action('admin_head', 'custom_logo');

function custom_login_logo() {
  echo '<style type="text/css">
    h1 a { 
    	background-image:url('.get_bloginfo('template_directory').'/images/login-logo.png) !important;
		background-size: 274px 182px !important;
		width: 274px !important;
    	height: 182px !important;
		margin-left: 20px !important;
   }
    </style>';
}

add_action('login_head', 'custom_login_logo');

// Create the function to output the contents of our Dashboard Widget
function help_dashboard_widget_function() {
	// Display whatever it is you want to show
	echo "
		<ul style=width:40%;float:left;margin-right:55px;min-width:153px;>
			<li style=color:#666;font-size:14px;border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#DFDFDF;padding-bottom:5px;margin-bottom:10px;>WordPress 101 Videos:</li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp101-video-training-part-1-the-dashboard/ target=_blank>The Dashboard</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-2-creating-a-new-post/ target=_blank>Creating A New Post</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-3-edit-existing-post/ target=_blank>Edit Existing Post</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-4-using-categories-and-tags/ target=_blank>Using Categories and Tag</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-5-creating-and-editing-pages/ target=_blank>Creating and Editing Pages</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-6-adding-images/ target=_blank>Adding Images &amp; Photos</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-7-embedding-video/ target=_blank>How to Embed Video</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-8-media-library/ target=_blank>Using the Media Library</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-9-managing-comments/ target=_blank>Managing Comments</a></li> 
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-10-creating-links/ target=_blank>Creating Links</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-12-widgets/ target=_blank>Adding Widgets</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-13-custom-menus/ target=_blank>Building Custom Menus</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-15-users/ target=_blank>Adding New Users</a></li>
		</ul>
		
		<ul style=width:40%;float:left;min-width:153px;>
			<li style=color:#666;font-size:14px;border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#DFDFDF;padding-bottom:5px;margin-bottom:10px;>Videos Specific To Your Site:</li>
			<li><a href=http://www.youtube.com/watch?v=Q15ahZDjXIM target=_blank>Adding Videos &amp; Podcasts</a></li>
			<li><a href=http://www.youtube.com/watch?v=Pb-PgIjRDHE target=_blank>Adding Products</a></li>
			<li><a href=http://www.youtube.com/watch?v=IE_10_nwe0c target=_blank>SEO Ultimate Tutorial</a></li>
			<li><a href=http://www.youtube.com/watch?v=KniQBKahhHI target=_blank>Managing ProsperousMedia</a></li>
		</ul>
		
		<p style=clear:both;padding-top:5px;margin-bottom:0.5em;color:#666;font-size:14px;>Helpful Quick Links:</p>
		
		<a href=http://google.com/analytics target=_blank>Analytics Login</a> | <a href=http://login.mailchimp.com>Mailchimp Login</a>
		
		<p>Still stuck?  Give us a call at <strong>(480) 648-8229</strong> or email us at <a href=mailto:info@sharpmachinemedia.com?subject=Help!><strong>info@sharpmachinemedia.com</strong></a>.
	";
} 

// Create the function use in the action hook
function help_add_dashboard_widgets() {
	wp_add_dashboard_widget('help_dashboard_widget', 'Need Help?', 'help_dashboard_widget_function');	
} 

// Hook into the 'wp_dashboard_setup' action to register our other functions
add_action('wp_dashboard_setup', 'help_add_dashboard_widgets' );

// Prevent already purchased items from being added again
function confirm_not_purchased($response, $id) {
	global $wpdb;
	$purchased_products = array();
	if (shopp('customer', 'has-purchases')) {
		while (shopp('customer','purchases')) {
			if (shopp('purchase', 'paid')) {
				if (shopp('purchase', 'has-items')) {
					while (shopp('purchase', 'items')) {
						$product_id = strval(intval(shopp('purchase', 'get-item-id')));
						$row = $wpdb->get_row('SELECT product FROM ' . $wpdb->prefix . 'shopp_purchased WHERE id = ' . $product_id, ARRAY_N);
						$purchased_products[] = $row[0];
					}
				}
			}
		}
	}
	if (in_array($id, $purchased_products)) {
		return false;
	} else {
		return true;
	}
}
add_filter('shopp_add_item', 'confirm_not_purchased', 10, 2);

// Prevent items from being added to the cart more than once
function add_only_once($response, $quantity) {
	return false;
}
add_filter('shopp_add_quantity', 'add_only_once', 10, 2);

/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>
