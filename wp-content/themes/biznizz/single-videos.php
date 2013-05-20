<?php get_header(); ?>

<?php // Let's get the data we need

	$vimeo_id = get_post_meta( $post->ID, 'vimeo_id', true );

?>
<?php global $woo_options; ?>
       
    <div id="content" class="col-full">
		<div id="main" class="col-left">
		           
		<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>

        <?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>
        
			<div <?php post_class(); ?>>

                <h1 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
  
                 <p class="post-meta">
				    <span class="post-date"><span class="small">Posted on</span> <?php the_date(); ?></span>
				    <span class="post-author"><span class="small">by</span> <?php the_author_posts_link(); ?></span>
				    <span class="post-category"><span class="small">in</span> <?php echo get_the_term_list( $post->ID, 'cateogories', '', ', ', '' ); ?></span>
				</p>

                <div class="entry">
                
               		<?php if ( $woo_options['woo_thumb_single'] == "true" ) woo_image('width='.$woo_options['woo_single_w'].'&height='.$woo_options['woo_single_h'].'&class=thumbnail '.$woo_options['woo_thumb_single_align']); ?>
               		
               		<div class="video">
               		<?php if ($vimeo_id) { // Check for a video ?>
					<iframe src="http://player.vimeo.com/video/<?php echo $vimeo_id; ?>?byline=0&title=0&portrait=0" width="636" height="358" frameborder="0" class="vimeo"></iframe>
				<?php } ?>
               		</div><br \>
                	<?php the_content(); ?>
				</div>
            </div><!-- .post -->

            <?php $comm = $woo_options['woo_comments']; if ( ($comm == "post" || $comm == "both") ) : ?>
                <?php comments_template('', true); ?>
            <?php endif; ?>
                                                
		<?php endwhile; else: ?>
			<div class="post">
            	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
			</div><!-- .post -->             
       	<?php endif; ?>  
        
		</div><!-- #main -->

        <?php get_sidebar(); ?>

    </div><!-- #content -->
		
<?php get_footer(); ?>