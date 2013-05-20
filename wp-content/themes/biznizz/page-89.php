<?php global $woo_options; ?>

<?php get_header(); ?>

   <div id="content" class="col-full">

		<div id="portfolio">
 
	        <?php $paged = get_query_var('paged'); query_posts("post_type=videos&cateogories=personal&posts_per_page=-1&paged=$paged"); ?>
	        <?php if (have_posts()) : while (have_posts()) : the_post(); $counter++; ?>		        					

                  
                <?php $vimeo_id = get_post_meta( $post->ID, 'vimeo_id', true );?>
                <!-- Post Starts -->
                <div class="post block fl <?php echo $porttag; ?> ">

						                    
                    <a rel="prettyPhoto[62]" title="" href="http://vimeo.com/<?php echo $vimeo_id;?>" class="thumb">
						<img src="<?php $imgid = $vimeo_id;
			 					$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			 					echo $hash[0]['thumbnail_large']; ?>" alt="<?php the_title(); ?>" class="woo-image portfolio-img"  width="450"  height="210"  />                    </a>
                    
                    
                    <h2 class="title"><?php the_title(); ?></h2>

                    <div class="entry">
	                    <?php the_content(); ?>
          
	                </div><!-- /.entry -->

                </div><!-- /.post -->  
                                                         
			<?php endwhile; else: ?>
			<p>Bummer, no videos in this category yet.  Check back soon!</p>
            <?php endif; ?>  

        	<div class="fix"></div>
        	
            <?php woo_pagenav(); ?>
                
		</div><!-- /#portfolio -->
        
    </div><!-- /#content -->    
        
<?php get_footer(); ?>