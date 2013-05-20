<section class="pm-account">

<h3>My Profile</h3>

<form action="<?php shopp('customer','action'); ?>" method="post" class="shopp validate pm-profile" autocomplete="off">

	<?php if(shopp('customer','password-changed')): ?>
	<div class="notice">Your password has been changed successfully.</div>
	<?php endif; ?>
	<?php if(shopp('customer','profile-saved')): ?>
	<div class="notice">Your account has been updated.</div>
	<?php endif; ?>

			<h3>Contact Information</h3><br>
			<label for="firstname">First</label>
			<?php shopp('customer','firstname','required=true&minlength=2&size=8&title=First Name'); ?>
			<label for="lastname">Last</label>
			<?php shopp('customer','lastname','required=true&minlength=3&size=14&title=Last Name'); ?>
			<label for="company">Company</label>
			<?php shopp('customer','company','size=20&title=Company'); ?>
			<label for="phone">Phone</label>
			<?php shopp('customer','phone','format=phone&size=15&title=Phone'); ?>
			<label for="email">Email</label>
			<?php shopp('customer','email','required=true&format=email&size=30&title=Email'); ?>
			

			<div class="inline"><label for="marketing"><?php shopp('customer','marketing','title=I would like to continue receiving e-mail updates and special offers!'); ?> I would like to continue receiving e-mail updates and special offers!</label></div>
	
		<?php while (shopp('customer','hasinfo')): ?>
			
			<label><?php shopp('customer','info','mode=name'); ?></label>
			<?php shopp('customer','info'); ?>
			
		<?php endwhile; ?>

			<h3>Change Your Password</h3><br>
			<label for="password">New Password</label>
			<?php shopp('customer','password','size=14&title=New Password'); ?>
			<label for="confirm-password">Confirm Password</label>
			<?php shopp('customer','confirm-password','&size=14&title=Confirm Password'); ?><br>

	
			<h3>Billing Information</h3><br>
			<label for="billing-address">Street Address</label>
			<?php shopp('customer','billing-address','title=Billing street address'); ?>

			<label for="billing-xaddress">Address Line 2</label>
			<?php shopp('customer','billing-xaddress','title=Billing address line 2'); ?>
	
			<label for="billing-city">City</label>
			<?php shopp('customer','billing-city','title=City billing address'); ?>

			<label for="billing-state">State / Province</label>
			<?php shopp('customer','billing-state','title=State/Provice/Region billing address'); ?>

			<label for="billing-postcode">Postal / Zip Code</label>
			<?php shopp('customer','billing-postcode','title=Postal/Zip Code billing address'); ?>

			<label for="billing-country">Country</label>
			<?php shopp('customer','billing-country','title=Country billing address'); ?>


		<!-- <li id="shipping-address-fields">
					<label for="shipping-address">Shipping Address</label>
					<div>
						<?php shopp('customer','shipping-address','title=Shipping street address'); ?>
						<label for="shipping-address">Street Address</label>
					</div>
					<div>
						<?php shopp('customer','shipping-xaddress','title=Shipping address line 2'); ?>
						<label for="shipping-xaddress">Address Line 2</label>
					</div>
					<div class="left">
						<?php shopp('customer','shipping-city','title=City shipping address'); ?>
						<label for="shipping-city">City</label>
					</div>
					<div class="right">
						<?php shopp('customer','shipping-state','title=State/Provice/Region shipping address'); ?>
						<label for="shipping-state">State / Province</label>
					</div>
					<div class="left">
						<?php shopp('customer','shipping-postcode','title=Postal/Zip Code shipping address'); ?>
						<label for="shipping-postcode">Postal / Zip Code</label>
					</div>
					<div class="right">
						<?php shopp('customer','shipping-country','title=Country shipping address'); ?>
						<label for="shipping-country">Country</label>
					</div>
				</li> -->

	<p><?php shopp('customer','save-button','label=Save'); ?></p>

</form>
</section>

<?php include('pm-menu.php') ?>