<form action="<?php shopp('checkout','url'); ?>" method="post" class="shopp validate" id="checkout">
<?php shopp('checkout','cart-summary'); ?>
<br>
<hr>
<?php if (shopp('cart','hasitems')): ?>
	<?php shopp('checkout','function'); ?>
		<section id="pm-column1" class="pm-column">
		<?php if (shopp('customer','notloggedin')): ?>
		
			<h3>New here?</h3>
			<label for="password">Email:</label>
			<?php shopp('checkout','email','required=true&format=loginnames&size=16&title=Email'); ?>
			<label for="password">Password:</label>
			<?php shopp('checkout','password','required=true&format=passwords&size=16&title=Password'); ?>
			<label for="confirm-password">Confirm Password:</label>
			<?php shopp('checkout','confirm-password','required=true&format=passwords&size=16&title=Password Confirmation'); ?>
			<div class="inline"><label for="marketing"><?php shopp('checkout','marketing', 'checked=yes'); ?> Yes, I would like to receive e-mail updates and special offers!</label></div>
		
		<?php endif; ?>
	
			<h3>Billing Information</h3>
			<label for="firstname">First Name:</label>
			<?php shopp('checkout','firstname','required=true&minlength=2&size=8&title=First Name'); ?>
			<label for="lastname">Last Name:</label>
			<?php shopp('checkout','lastname','required=true&minlength=3&size=14&title=Last Name'); ?>
			<label for="company">Company/Organization:</label>
			<?php shopp('checkout','company','size=22&title=Company/Organization'); ?>
			<label for="phone">Phone:</label>
			<?php shopp('checkout','phone','format=phone&size=15&title=Phone'); ?>
			<?php if (shopp('customer','loggedin')): ?>
			<label for="email">Email:</label>
			<?php shopp('checkout','email','required=true&format=email&size=30&title=Email'); ?>
			<?php endif; ?>

			<label for="billing-address">Street Address</label>
			<?php shopp('checkout','billing-address','required=true&title=Billing street address'); ?>
			
			<label for="billing-xaddress">Address Line 2</label>
			<?php shopp('checkout','billing-xaddress','title=Billing address line 2'); ?>
			
			<label for="billing-city">City</label>
			<?php shopp('checkout','billing-city','required=true&title=City billing address'); ?>
			
			<label for="billing-state">State/Province</label>	
			<?php shopp('checkout','billing-state','required=true&title=State/Provice/Region billing address'); ?>
				
			<label for="billing-postcode">Postal / Zip Code</label>
			<?php shopp('checkout','billing-postcode','required=true&title=Postal/Zip Code billing address'); ?>
			<label for="billing-country">Country</label>
			<?php shopp('checkout','billing-country','required=true&title=Country billing address'); ?>
				
	
	
			<?php shopp('checkout','payment-options'); ?>
			<?php shopp('checkout','gateway-inputs'); ?>
	
		<?php if (shopp('checkout','card-required')): ?>

			<label for="billing-card">Payment Information</label>
			<span><?php shopp('checkout','billing-card','required=true&size=30&title=Credit/Debit Card Number'); ?><label for="billing-card">Credit/Debit Card Number</label></span>
			<span><?php shopp('checkout','billing-cardexpires-mm','size=4&required=true&minlength=2&maxlength=2&title=Card\'s 2-digit expiration month'); ?> /<label for="billing-cardexpires-mm">MM</label></span>
			<span><?php shopp('checkout','billing-cardexpires-yy','size=4&required=true&minlength=2&maxlength=2&title=Card\'s 2-digit expiration year'); ?><label for="billing-cardexpires-yy">YY</label></span>
			<span><?php shopp('checkout','billing-cardtype','required=true&title=Card Type'); ?><label for="billing-cardtype">Card Type</label></span>
	
			<span><?php shopp('checkout','billing-cardholder','required=true&size=30&title=Card Holder\'s Name'); ?><label for="billing-cardholder">Name on Card</label></span>
			<span><?php shopp('checkout','billing-cvv','size=7&minlength=3&maxlength=4&title=Card\'s security code (3-4 digits on the back of the card)'); ?><label for="billing-cvv">Security ID</label></span>
	
		<?php if (shopp('checkout','billing-xcsc-required')): // Extra billing security fields ?>
	
		<span><?php shopp('checkout','billing-xcsc','input=start&size=7&minlength=5&maxlength=5&title=Card\'s start date (MM/YY)'); ?><label for="billing-xcsc-start">Start Date</label></span>
			<span><?php shopp('checkout','billing-xcsc','input=issue&size=7&minlength=3&maxlength=4&title=Card\'s issue number'); ?><label for="billing-xcsc-issue">Issue #</label></span>
	
		<?php endif; ?>

		<?php endif; ?>
		<p class="pm-paypal-notice"><img src="<?php bloginfo('template_directory') ?>/images/cards.png" width="144" height="21" alt="Cards">All payments securely processed by<img src="<?php bloginfo('template_directory') ?>/images/paypal.png" width="74" height="21" alt="Paypal"></p>

		<p class="submit"><span><input type="submit" name="process" id="checkout-button"  value="Submit Order" class="checkout-button" /></span></p>

<?php endif; ?>
</section><!-- #pm-column1 -->

<?php if (shopp('customer','notloggedin')): ?>
<section class="pm-column">
		<h3>Already a member?</h3>
		<label for="account-login">Email:</label>
		<?php shopp('customer','account-login','size=20&title=Login'); ?>
		<label for="password-login">Password:</label>
		<?php shopp('customer','password-login','size=20&title=Password'); ?><br>
		<?php shopp('customer','login-button','context=checkout&value=Login'); ?><br>

</section>
<?php endif; ?>
</form>
