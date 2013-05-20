<?php global $woo_options; ?>
<div id="slides">

	<?php $slides = get_posts('post_type=slide&showposts='.$woo_options['woo_slider_entries']); ?>
	<?php if (!empty($slides)) : ?>
		<div class="slides_container col-full">  
		<?php foreach($slides as $post) : setup_postdata($post); ?>
			
			<div class="slide">
			
				<div class="slide-content fl" <?php if ( !get_post_meta($post->ID, 'slide-image', $single = true) && !get_post_meta($post->ID, 'embed', true) ) { echo 'style="width:auto;"'; } elseif (get_post_meta($post->ID, 'embed', true)) { echo 'style="width:380px;"'; } ?>>
				
					<h2 class="title"><?php the_title(); ?></h2>
					
					<?php the_content(); ?>
				
				</div><!-- /.slide-content -->
				
				<?php if ( get_post_meta($post->ID, 'slide-image', $single = true) || get_post_meta($post->ID, 'embed', true) ): ?>
				
				<div class="slide-image fr">
					
					<?php if ( get_post_meta($post->ID, 'slide-image', $single = true) ) { ?>
						<img class="slide-img" src="<?php echo get_post_meta($post->ID, 'slide-image', $single = true); ?>" alt="" />
					<?php } elseif ( get_post_meta($post->ID, 'embed', $single = true) ) {
						echo woo_embed('key=embed&width=520&height=320&class=video');
					} ?>
					
				</div><!-- /.slide-image -->				
				<?php endif; ?>
				
				<div class="fix"></div>
					
			</div><!-- /.slide -->
			
		<?php endforeach; ?>
						
		</div><!-- /.slides_container -->
	<?php endif; ?>
	
	<?php if ($woo_options['woo_slider_navigation'] == 'true'): ?>
	<div class="slide-nav">
		<div class="pagination col-full">
			<ul>
				<?php $slides = get_posts('post_type=slide&showposts='.$woo_options['woo_slider_entries']); ?>
				<?php if (!empty($slides)) : ?>
					<?php foreach($slides as $post) : setup_postdata($post); ?>
						<li>
							<a href="#">
								<span class="title"><?php the_title(); ?></span>
								<?php if (get_post_meta($post->ID, 'slide-description', $single = true)): ?><span class="content"><?php echo stripslashes(get_post_meta($post->ID, 'slide-description', $single = true)); ?></span><?php endif; ?>
							</a>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div><!--/.pagination col-full-->
	</div>
	<div id="slider-bg-shadow"></div>
	<?php endif; ?>

	
</div><!-- /#slides -->
