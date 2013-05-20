<form action="<?php shopp('customer','url'); ?>" method="post" class="shopp pm-password-recover" id="login">

<h3>Recover your password</h3>
	<?php shopp('customer','login-errors'); ?>
	<label for="login"><?php shopp('customer','login-label'); ?></label>
	<?php shopp('customer','account-login','size=20&title=Login'); ?><br>
	<?php shopp('customer','recover-button'); ?>
</form>
