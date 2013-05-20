<?php get_header(); ?>
<?php global $woo_options; ?>
       
    <div id="content" class="page col-full">

		     
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>

            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
                <div class="post">
	
                    <h1 class="title">
						<img src="<?php bloginfo('template_directory') ?>/images/img-prosperousmedia2.png" width="957" height="474" alt=" Prosperousmedia">
					</h1>
					<hr>
					
					<!-- <?php if (shopp('customer','notloggedin')): ?>
								<section id="pm-sign-in">
									<h3>Already a Member?</h3>
									<form action="<?php shopp('customer','url'); ?>" method="post" class="shopp" id="login">
									<ul>
										
										<li><?php shopp('customer','errors'); ?></li>
										<li>
											<label for="login"><?php shopp('customer','login-label'); ?></label>
											<?php shopp('customer','account-login','size=20&title=Login'); ?>
										</li>
										<li>
											<label for="password">Password</label>
											<?php shopp('customer','password-login','size=20&title=Password'); ?>
										</li>
										<li>
											<?php shopp('customer','login-button'); ?>
										</li>
										
									</ul>
									</form>
								</section>
									<?php endif; ?> -->
                 <div class="entry pm-featured">
					<h1 class="in-charge">Digital teachings to help you thrive</h1>
					<div class="pm-feature-box">
						<img src="<?php bloginfo('template_directory'); ?>/images/ico-product.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />
						Move from a poverty mindset, into a prosperous one
					</div>
					<div class="pm-feature-box">
						<img src="<?php bloginfo('template_directory'); ?>/images/ico-product.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />
						Learn practical tools to get out of debt and manage finances
					</div>
					<div class="pm-feature-box last">
						<img src="<?php bloginfo('template_directory'); ?>/images/ico-product.png" width="50" height="50" alt="Ico Tools" alt="" class="home-icon" />
						Make money your slave, and you, the Master
					</div>
					
					<div class="get-started">
						<a href="<?php bloginfo('url') ?>/pm" class="pm-button"><span>Get Started</span></a>
						
					</div>
					
					
                   	<?php the_content(); ?> 
                 
                 </div><!-- /.entry --> 
                   
                    
                </div><!-- /.post -->
                
                <?php $comm = $woo_options['woo_comments']; if ( ($comm == "page" || $comm == "both") ) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>
                                                    
			<?php endwhile; endif; ?>  
        




    </div><!-- /#content -->
		
<?php get_footer(); ?>