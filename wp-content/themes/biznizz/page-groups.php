<?php get_header(); ?>
<?php global $woo_options; ?>
       
    <div id="content" class="page col-full">
		<div id="main" class="col-left">
		           
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>

            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
                <div class="post">

                    <h1 class="title"><?php the_title(); ?></h1>

                    <div class="entry">
	                	<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
	               	</div><!-- /.entry -->

					<?php edit_post_link( __('{ Edit }', 'woothemes'), '<span class="small">', '</span>' ); ?>
                    
                </div><!-- /.post -->
                
                <?php $comm = $woo_options['woo_comments']; if ( ($comm == "page" || $comm == "both") ) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>
                                                    
			<?php endwhile; else: ?>
				
				<div class="post">
                	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
                </div><!-- /.post -->
            <?php endif; ?>  
            
             <div id="mini-features">
	        
	        	<div class="block ">	
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />
	                <div class="feature last">
		                <h3><a href="financial-tools" title="Financial Tools">Financial Tools</a></h3>
		            	 <?php $page_id = 376; 
								$page_data = get_page( $page_id ); 
								$content = apply_filters('the_content', $page_data->post_content); 
								echo $content; 
						?>
	                </div>
				</div>
							
				<div class="block last">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-podcast.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />			
	                 <div class="feature last">
		                  <h3><a href="podcasts">Recent Podcasts</a></h3>
		                  
		                   <?php query_posts("post_type=podcasts&cateogories=groups&posts_per_page=-4"); ?>
		                   <ul>
	        <?php if (have_posts()) : while (have_posts()) : the_post(); $counter++; ?>
	        	
	        	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	        	
	        	<?php endwhile; ?>
	        	 </ul>
	                   <a href="podcasts">View All Podcasts &rarr;</a>
	        	<?php else: ?>
						<p>Sorry, no Podcasts for Groups yet.  Check back soon!</p>
            <?php endif; ?>  
	                  
	                 </div>
				</div>
				
				<div class="fix"></div>				
	                
				<div class="block ">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-product.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />			
	            	<div class="feature">
	                   <h3><a href="../store" title="Store">Products</a></h3>
	                   <?php $page_id = 437; 
								$page_data = get_page( $page_id ); 
								$content = apply_filters('the_content', $page_data->post_content); 
								echo $content; 
						?>
	              	</div>
				</div>
								
				<div class="block last">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-videos.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				      
	                <div class="feature">
	                   <h3><a href="videos">Recent Videos</a></h3>
	                   
	                   <?php query_posts("post_type=videos&cateogories=groups&posts_per_page=-3"); ?>
	                   <ul>
	        <?php if (have_posts()) : while (have_posts()) : the_post(); $counter++; ?>
	        	
	        	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	        	
	        	<?php endwhile; ?>
	        	   </ul>
	                   <a href="videos">View All Videos &rarr;</a>
	        	<?php else: ?>
				<p>Sorry, no Videos for Groups yet.  Check back soon!</p>
            <?php endif; ?>  
	                
	                   
	                </div>
				</div>
			
				<div class="fix"></div>	
							
	        </div><!-- /#mini-features -->

            <div id="latest-blog-posts">
        		<h3><?php echo _e('From Library', 'woothemes'); ?></h3>
            
       <?php if ( get_query_var('paged') ) $paged = get_query_var('paged'); elseif ( get_query_var('page') ) $paged = get_query_var('page'); else $paged = 1; ?>
        <?php query_posts("post_type=post&paged=$paged&cat=-6, -5&posts_per_page=4"); ?>
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
			</div> <!-- /.latest-blog-posts -->     
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>