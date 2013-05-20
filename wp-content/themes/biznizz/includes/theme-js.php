<?php
if (!is_admin()) add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
if (!function_exists('woothemes_add_javascript')) {
	function woothemes_add_javascript( ) {
		wp_enqueue_script('jquery');    
		wp_enqueue_script( 'superfish', get_bloginfo('template_directory').'/includes/js/superfish.js', array( 'jquery' ) );
		if (is_home()) 
			wp_enqueue_script( 'slides', get_bloginfo('template_directory').'/includes/js/slides.min.jquery.js', array( 'jquery' ) );
			wp_enqueue_script( 'jcarousel', get_bloginfo('template_directory').'/includes/js/jcarousel.js', array( 'jquery' ) );
		if (is_page('Store')||('Videos')) {
			wp_enqueue_script( 'prettyPhoto', get_bloginfo('template_directory').'/includes/js/jquery.prettyPhoto.js', array( 'jquery' ) );					
			wp_enqueue_script( 'portfolio', get_bloginfo('template_directory').'/includes/js/portfolio.js', array( 'jquery' ) );
		}
	}
}
?>