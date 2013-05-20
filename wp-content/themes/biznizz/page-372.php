<?php get_header(); ?>

       
    <div id="content" class="page col-full">
		<div id="main" class="col-left">
		     
		           
		           <div id="mini-features">
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>
			 <?php query_posts("post_type=podcasts&cateogories=groups"); ?>
            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
            	
            	<div class="block-podcasts">
					<a href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ico-podcast.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" /></a>			
	                 <div class="feature">
		                  <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		                 <?php the_excerpt(); ?>
	                 </div>
				</div>
                                               
			<?php endwhile; else: ?>
				
				<div class="post">
                	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
                </div><!-- /.post -->
            <?php endif; ?>  
             <?php woo_pagenav(); ?>
        </div>
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>