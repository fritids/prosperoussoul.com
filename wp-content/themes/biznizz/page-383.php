<?php get_header(); ?>
<?php global $woo_options; ?>
       
    <div id="content" class="page col-full">
		<div id="main" class="col-left">
		          
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>

			<div class="post">
				 <h1 class="title">Financial Tools</h1>
			 </div><!-- /.post -->
            
        <div id="mini-features">
        	
        	<h2>Calculators</h2>
        	<!--cash flow-->
	        	<div class="block">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>Cash Flow</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=cash-flow"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<!--credit and time value-->
				<div class="block last">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>Credit &amp; Time Value</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=credit-time-value"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<!--college-->
				
				<div class="block">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>College</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=college"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<!--home and mortgage-->
				<div class="block last">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>Home &amp; Mortgage</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=home-mortgage"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<!--taxation-->
				<div class="block">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>Taxation</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=taxation"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<!--insurance-->
				<div class="block last">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>Insurance</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=insurance"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<!--retirement-->
				<div class="block">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>Retirement</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=retirement"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<!--pay and benefits-->
				<div class="block last">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>Pay &amp; Benefits</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=pay-benefits"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<!--saving-->
				<div class="block">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>Saving</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=savings"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<!--investments-->
				<div class="block last">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>Investments</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=investments"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<!--auto-->
				<div class="block">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		                <h3>Auto</h3>
		   				 <?php query_posts("post_type=calculators&cateogories=enterprise&calculator_type=auto"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php meta('calculator_url'); ?>" rel="bookmark" title="<?php the_title(); ?>" class="fancybox-iframe"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				<h2 style="clear: both;">Seminar Handouts</h2>
				<div class="block">
					<img src="<?php bloginfo('template_directory'); ?>/images/ico-tools.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />				
	                <div class="feature">
		   				 <?php query_posts("post_type=handouts&cateogories=enterprise"); ?>
            			<?php if (have_posts()) : $count = 0; ?>
            				<ul>
            				<?php while (have_posts()) : the_post(); $count++; ?>
                    			<li><a href="<?php echo get_field('handout_sheet_pdf'); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
								<?php endwhile; else: ?>
							
				<p>Sorry, no calulators for this category</p>
				<?php endif; ?>  
				
							</ul>
	                </div>
				</div>
				
				
				
				
				
				
				
			</div><!-- #mini-feature-->
       		
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>