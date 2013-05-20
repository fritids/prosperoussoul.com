<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<?php global $woo_options; ?>

<link href='http://fonts.googleapis.com/css?family=Crimson+Text:400,600,700&v2' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/overrides.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/includes/prettyPhoto.css" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( $woo_options['woo_feed_url'] ) { echo $woo_options['woo_feed_url']; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico">

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
      
<?php wp_head(); ?>
<?php woo_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php woo_top(); ?>

<div id="wrapper">
    
    <div id="header-out">
    
	    <div id="header">
	               
			<div id="top" class="col-full">
		 		       
				<div id="logo" class="col-left">
			       
				<?php if ($woo_options['woo_texttitle'] <> "true") : $logo = $woo_options['woo_logo']; ?>
					<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">
						<img src="<?php if ($logo) echo $logo; else { bloginfo('template_directory'); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" />
					</a>
		        <?php endif; ?> 
		        
		        <?php if( is_singular() && !is_front_page() ) : ?>
					<span class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
		        <?php else : ?>
					<h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		        <?php endif; ?>
					<span class="site-description"><?php bloginfo('description'); ?></span>
			      	
				</div><!-- /#logo -->
				<div class="pm-header">
		        <?php if (shopp('customer','notloggedin')): ?>
			Have a ProsperousMedia account? <a href="<?php bloginfo('url') ?>/pm/account/">Log In</a>
			<?php else: ?>
				ProsperousMedia: <a href="<?php bloginfo('url') ?>/pm/account/">My Account</a> | <a href="<?php bloginfo('url') ?>/mylibrary/account/?logout">Logout</a>
				<?php endif; ?>
				
				</div>
				<div id="navigation" class="col-right">
					<?php wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'custom_menus' ) ); ?>
			
			        <div class="fix"></div>
				        <ul id="second-nav" class="nav fl">
				        	<li>
				        		<a href="<?php bloginfo('url'); ?>/personal/">Personal<img src="<?php bloginfo('template_directory'); ?>/images/personal-menu.png" width="13" height="36" alt="Personal Menu"></a>
			        		</li> 
							<li>
								<a href="<?php bloginfo('url'); ?>/enterprise/">Enterprise<img src="<?php bloginfo('template_directory'); ?>/images/enterprise-menu.png" width="37" height="36" alt="Enterprise Menu"></a>
							</li> 
							<li>
								<a href="<?php bloginfo('url'); ?>/groups/">Groups<img src="<?php bloginfo('template_directory'); ?>/images/groups-menu.png" width="33" height="36" alt="Groups Menu"></a>
							</li> 
					</ul>
				</div><!-- /#navigation -->	        
		    
		   		<div class="fix"></div>
		    
		    </div><!-- /#top -->
		    
		    <?php if ($woo_options['woo_slider'] == 'true' && is_home()) include ( TEMPLATEPATH . '/includes/featured.php' ); ?>
	       
		</div><!-- /#header -->

	</div><!-- /#header-out -->