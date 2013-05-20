<?php get_header(); ?>
<?php

global $woo_options;

$is_purchased = false;

// Get all purchased product IDs
$ordered_products = array();
if (shopp('customer', 'has-purchases')) {
	while (shopp('customer','purchases')) {
		if (shopp('purchase', 'paid')) {
			if (shopp('purchase', 'has-items')) {
				while (shopp('purchase', 'items')) {
					$product_id = strval(intval(shopp('purchase', 'get-item-id')));
					$row = $wpdb->get_row('SELECT product FROM ' . $wpdb->prefix . 'shopp_purchased WHERE id = ' . $product_id, ARRAY_N);
					$ordered_products[] = $row[0];
				}
			}
		}
	}
}

// Get all Shopp products associated with this video
$linked_product_ids = array();
$pm_shopp_links = get_post_meta($post->ID, 'pm_shopp_links');
if (isset($pm_shopp_links[0]))
	$linked_product_ids = $pm_shopp_links[0];

// Check if this video has been purchased
foreach ($linked_product_ids as $linked_product_id) {
	if (in_array($linked_product_id, $ordered_products)) {
		$is_purchased = true;
		break;
	}
}

?>
       
    <div id="content" class="col-full">
	
		
		<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>

        <?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>
        
			<div <?php post_class(); ?>>
				<section class="pm-videos-header">
					<div class="pm-video-titles">
						<h1 class="title"><?php the_title(); ?></h1>
	                	<h2 class="title"><?php the_field('pm_subheader'); ?></h2>
					</div>
                	<div class="pm-video-ad">
                		<a href="<?php the_field('pm_ad_url') ?>"><img src="<?php the_field('pm_ad') ?>" alt=""></a>
                	</div>             
                </section>

				<div id="pm-video-container">
					<?php if (shopp('customer','notloggedin')): ?>
						<img src="<?php bloginfo('template_directory') ?>/images/img-no-vid.png" width="640" height="360" alt="Img No Vid" alt="" class="pm-video-notloggedin" />
					<?php else: ?>
						<?php if ($is_purchased): ?>
						<iframe src="http://player.vimeo.com/video/<?php the_field('pm_vimeo_id') ?>?title=0&amp;byline=0&amp;portrait=0" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						<?php else: ?>
						<!-- <h3 class="video-error">Sorry, you haven't purchased this video yet.</h3>
												<p class="video-error"><a href="<?php bloginfo('url'); ?>/pm/<?php echo $post->post_name; ?>/">View in store</a></p> -->
						<img src="<?php bloginfo('template_directory') ?>/images/img-no-vid.png" width="640" height="360" alt="Img No Vid" alt="" class="pm-video-notloggedin" />
					<?php endif; ?>
				<?php endif; ?>
					
            	</div>
				
				<section class="pm-video-functions">
					<div id="pm-video-nav">
		            	<div class="nav-next fr"><?php next_post_link( '%link', '<span class="meta-nav">Next Video &raquo;</span>' ) ?></div>
		            	<div class="fix"></div>
		        	</div>
					<?php if (shopp('customer','loggedin')): ?>
						<?php if(get_field('pm_pdf')): ?>
						<ul class="mymedia-actions">
							<li><a href="<?php the_field('pm_pdf') ?>">Download PDF</a></li>
						</ul>
						<?php endif; ?>
				<?php endif; ?>
					<?php if (!$is_purchased): ?>
						<h2>Sorry, you haven't purchased this video yet.  <a class="" href="<?php bloginfo('url'); ?>/pm/<?php echo $post->post_name; ?>/">Purchase in Media Store</a></h2>
						
						<?php endif; ?>
				</section>
				
				<section class="pm-video-description">
					
					<div class="pm-video-featured-image">
						<?php if ( has_post_thumbnail() ): ?> 
							<?php woo_image('width=100&height=80&class=thumbnail alignleft'); ?>
							<?php else: ?>
							<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2012/06/placeholder-100x80.png" alt="<?php the_title(); ?>" class="thumbnail alignleft" />
							<?php endif; ?>
					</div>
					
					
                <div class="entry">
                
               		<?php if ( $woo_options['woo_thumb_single'] == "true" ) woo_image('width='.$woo_options['woo_single_w'].'&height='.$woo_options['woo_single_h'].'&class=thumbnail '.$woo_options['woo_thumb_single_align']); ?>
						<?php if (shopp('customer','notloggedin')): ?>
							<h3>You are not logged in</h3>
							<p>To view this video please <a href="<?php bloginfo('url') ?>/pm/account">login.</a></p>

							<h3>Not a Member?</h3>
							<div class="get-started" style="text-align: left;">
								<a href="<?php bloginfo('url') ?>/pm" class="pm-button"><span>Get Started</span></a>
							</div>
							
						<?php else: ?>
							<h3>Description</h3>
		                	<?php the_content(); ?>
					<?php endif; ?>
		
					<?php if (shopp('customer','loggedin')): ?>
						<?php $comm = $woo_options['woo_comments']; if ( ($comm == "post" || $comm == "both") ) : ?>
						<?php comments_template('', true); ?>
					<?php endif; ?>
					
	
		            <?php endif; ?>
				</div>
				
				</section>					
            </div><!-- .post -->
                      
		<?php endwhile; endif; ?>  

    </div><!-- #content -->
		
<?php get_footer(); ?>
