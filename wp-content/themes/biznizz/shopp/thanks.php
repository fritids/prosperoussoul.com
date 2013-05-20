<h3>Thank you for your order!</h3>

<?php if (shopp('checkout','completed')): ?>

<?php if (shopp('purchase','notpaid')): ?>
	<p>Your order has been received but the payment has not yet completed processing.</p>
	
	<?php if (shopp('checkout','offline-instructions','return=1')): ?>
	<p><?php shopp('checkout','offline-instructions'); ?></p>
	<?php endif; ?>
	
	<?php if (shopp('purchase','hasdownloads')): ?>
	<p>The download links on your order receipt will not work until the payment is received.</p>
	<?php endif; ?>

	<?php if (shopp('purchase','hasfreight')): ?>
	<p>Your items will not ship out until the payment is received.</p>
	<?php endif; ?>

<?php endif; ?>

<?php shopp('checkout','receipt'); ?>

<?php if (shopp('customer','wpuser-created')): ?>
	<p>An email was sent with account login information to the email address provided for your order.  <a href="<?php shopp('customer','url'); ?>">Login to your account</a> to access your orders, change your password and manage your checkout information.</p>
<?php endif; ?>

<?php else: ?>

<p>Your order is still in progress and has not yet been received from the payment processor. You will receive an email notification when your payment has been verified and the order has been completed.</p>

<?php endif; ?>

<?php if (shopp('customer','notloggedin')): ?>
	<p>To view your new media, login to your account.</p>
			<section id="pm-sign-in">
				<form action="<?php shopp('customer','url'); ?>" method="post" id="login" class="pm-thanks">
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
						<?php shopp('customer','login-button'); ?>
					</li>
					
				</ul>
				</form>
			</section>
			<p><a href="<?php shopp('customer','recover-url'); ?>">Lost your password?</a></p>
				

<?php endif; ?>
