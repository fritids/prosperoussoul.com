<?php if (shopp('customer','notloggedin')): ?>
	
			<section id="pm-sign-in">
				<form action="<?php shopp('customer','url'); ?>" method="post" id="login">
				<ul>
					
					<?php shopp('customer','errors'); ?>
					<li>
						<label for="login"><?php shopp('customer','login-label'); ?></label>
						<?php shopp('customer','account-login','size=20&title=Login'); ?>
					</li>
					<li>
						<label for="password">Password</label>
						<?php shopp('customer','password-login','size=20&title=Password'); ?>
					</li>
					<li>
						<div class="pm-login-button">
						<?php shopp('customer','login-button'); ?>
						</div>
					</li>
					
				</ul>
				</form>
			</section>
			<p><a href="<?php shopp('customer','recover-url'); ?>">Lost your password?</a></p>
				

<h3>Not a Member?</h3>
<div class="get-started" style="text-align: left;">
	<a href="<?php bloginfo('url') ?>/pm" class="pm-button"><span>Get Started</span></a>
</div>

<?php endif; ?>