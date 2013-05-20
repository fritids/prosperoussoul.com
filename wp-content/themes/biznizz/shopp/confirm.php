<?php shopp('checkout','cart-summary'); ?>

<form action="<?php shopp('checkout','url'); ?>" method="post" class="shopp" id="checkout">
	<?php shopp('checkout','function','value=confirmed'); ?>
	<p class="pm-paypal-notice tar"><img src="<?php bloginfo('template_directory') ?>/images/cards.png" width="144" height="21" alt="Cards">All payments securely processed by<img src="<?php bloginfo('template_directory') ?>/images/paypal.png" width="74" height="21" alt="Paypal"></p>

	<p class="submit"><span><input type="submit" name="process" id="checkout-button"  value="Confirm Order" class="checkout-button" /></span></p>
</form>
