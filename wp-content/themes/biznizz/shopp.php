<?php get_header(); ?>
<?php global $woo_options; ?>
       
    <div id="content" class="page col-full pm-shopp">
		
		           

            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                        
                <div class="post">
                    <h1 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

                    <div class="entry">
	                	<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
	               	</div><!-- /.entry -->

					<div class="clear"></div>
                    
                </div><!-- /.post -->
                
                <?php $comm = $woo_options['woo_comments']; if ( ($comm == "page" || $comm == "both") ) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>
                                                    
			<?php endwhile; else: ?>
				
				<div class="post">
                	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
                </div><!-- /.post -->
            <?php endif; ?>  




    </div><!-- /#content -->
		
<?php get_footer(); ?>