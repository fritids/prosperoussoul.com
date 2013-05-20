<?php get_header(); ?>
<?php global $woo_options; ?>

    <div id="content" class="col-full">

<!-- Recent Blog Post -->

<div>

    <div id="latest-blog-posts" style="float:left; width:480px;padding:10px;">
            		<h3><?php echo _e('From Library', 'woothemes'); ?></h3>
                
           <?php if ( get_query_var('paged') ) $paged = get_query_var('paged'); elseif ( get_query_var('page') ) $paged = get_query_var('page'); else $paged = 1; ?>
            <?php query_posts("post_type=post&paged=$paged&cat=-6, -10&posts_per_page=4"); ?>
            <?php if (have_posts()) : $count = 0; while (have_posts()) : the_post(); $count++; ?>
                         
                <!-- Post Starts -->
    	                <div class="item">
    					        	<?php woo_image('width=100&height=80&class=thumbnail alignleft'); ?> 
    					        	<h4><a class="title" href="<?php echo get_permalink($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h4>
    					            <p class="post-meta">
    					                <span class="small"><?php _e('by', 'woothemes') ?></span> <span class="post-author"><?php the_author_posts_link(); ?></span>
    					                <span class="small"><?php _e('on', 'woothemes') ?></span> <span class="post-date"><?php the_time(get_option('date_format')); ?></span>
    					                <span class="small"><?php _e('in', 'woothemes') ?></span> <span class="post-category"><?php the_category(', ') ?> | <?php comments_popup_link(__('Leave a comment', 'woothemes'), __('1 Comment', 'woothemes'), __('% Comments', 'woothemes')); ?></span>
    					            </p>
    					            <p><?php echo woo_text_trim( get_the_excerpt(), 25); ?> <span class="read-more"><a href="<?php the_permalink() ?>" title="<?php _e('Continue Reading &rarr;','woothemes'); ?>"><?php _e('Continue Reading &rarr;','woothemes'); ?></a></span></p>
    					        </div>
        
            <?php endwhile; else: ?>
           
                    <p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
                
            <?php endif; ?>  
         <a href="blog">View All Posts</a>
    </div> 

    <!-- End Blog -->
    <!-- Facebook Social Plugin Like Box -->

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <div style="float:left; width:450px; margin:40px 0px 0px 10px;" class="fb-like-box" data-href="https://www.facebook.com/pages/Prosperous-Soul/105378222849509" data-width="400" data-height="690" data-show-faces="false" data-stream="true" data-header="false"></div>

</div>

<!-- End Facebook Like Box -->


		<div id="main" class="col-left">  

		
	        <?php if ( $woo_options['woo_main_page1'] && $woo_options['woo_main_page1'] <> "Select a page:" ) { ?>
	        <div id="main-page1">
				<?php query_posts('page_id=' . get_page_id($woo_options['woo_main_page1'])); ?>
	            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>		        					
			    <div class="entry"><?php the_content(); ?></div>
	            <?php endwhile; endif; ?>
	            <div class="fix"></div>
	        </div><!-- /#main-page1 -->
	        <?php } ?>		    
            
            <?php if ($woo_options['woo_mini_features'] == "true"): ?>
	        <div id="mini-features">
	        
	        <?php query_posts('post_type=infobox&order=ASC&posts_per_page=20'); ?>
	        <?php if (have_posts()) : while (have_posts()) : the_post(); $counter++; ?>		        					
	
				<?php 
					$icon = get_post_meta($post->ID, 'mini', true); 
					$excerpt = stripslashes(get_post_meta($post->ID, 'mini_excerpt', true)); 
					$button = get_post_meta($post->ID, 'mini_readmore', true);
				?>
				<div class="block <?php if ($counter == 2) echo 'last'; ?>">
					<?php if ( $icon ) { ?>
	                <img src="<?php echo $icon; ?>" alt="" class="home-icon" />				
	                <?php } ?> 
	                                                     
	                <div class="<?php if ( $icon ) echo 'feature'; if ( $counter == 2 ) echo ' last'; ?>">
	                   <h3><?php echo get_the_title(); ?></h3>
	                   <p><?php echo $excerpt; ?></p>
	                   <?php if ( $button ) { ?><a href="<?php echo $button; ?>" class="btn"><?php _e('Read More', 'woothemes'); ?></a><?php } ?>
	                </div>
				</div>
				<?php if ( $counter == 2 ) { $counter = 0; echo '<div class="fix"></div>'; } ?>				
	                
	        <?php endwhile; endif; ?>
	
	            <div class="fix"></div>
	        </div><!-- /#mini-features -->
	        <?php endif; ?>	

	        <?php if ( $woo_options['woo_main_page2'] && $woo_options['woo_main_page2'] <> "Select a page:" ) { ?>
	        <div id="main-page2" class="home-page">
				<?php query_posts('page_id=' . get_page_id($woo_options['woo_main_page2'])); ?>
	            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>		        					
			    <div class="entry"><?php the_content(); ?></div>
	            <?php endwhile; endif; ?>
	            <div class="fix"></div>
	        </div><!-- /#main-page2 -->
	        <?php } ?>
	        
	        <?php if ($woo_options['woo_latest'] == "true"): ?>
	        <div id="latest-blog-posts">
	        
				<h3><?php echo _e('From Library', 'woothemes'); ?></h3>
				
				<div>
					<?php
						 $posts = $woo_options['woo_latest_entries'];
						 query_posts('posts_per_page='.$posts);
						 if ( have_posts() ) : while ( have_posts() ) : the_post();
					?>
					    <div class="item">
				        	<?php woo_image('width=100&height=80&class=thumbnail alignleft'); ?> 
				        	<h4><a class="title" href="<?php echo get_permalink($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h4>
				            <p class="post-meta">
				                <span class="small"><?php _e('by', 'woothemes') ?></span> <span class="post-author"><?php the_author_posts_link(); ?></span>
				                <span class="small"><?php _e('on', 'woothemes') ?></span> <span class="post-date"><?php the_time(get_option('date_format')); ?></span>
				                <span class="small"><?php _e('in', 'woothemes') ?></span> <span class="post-category"><?php the_category(', ') ?></span>
				            </p>
				            <p><?php echo woo_text_trim( get_the_excerpt(), 25); ?> <span class="read-more"><a href="<?php the_permalink() ?>" title="<?php _e('Continue Reading &rarr;','woothemes'); ?>"><?php _e('Continue Reading &rarr;','woothemes'); ?></a></span></p>
				        </div>
					    
					<?php endwhile; endif; ?>
				</div>
				
			</div><!-- /#latest-blog-posts -->	
			<?php endif; ?>	   
			
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage')) : ?>

<?php endif; ?>     
                
		</div><!-- /#main -->

       

    </div><!-- /#content -->
		
<?php get_footer(); ?>