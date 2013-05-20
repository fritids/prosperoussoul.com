<?php if (shopp('cart','hasitems')): ?>
<form id="cart" action="<?php shopp('cart','url'); ?>" method="post">
<big>
	<a href="<?php shopp('cart','referrer'); ?>">&laquo; Continue Shopping</a>
</big>

<?php shopp('cart','function'); ?>
<table class="cart">
	<colgroup>
		<col class="col-1"/>
		<col class="col-2" />
		<col class="col-3"/>
	</colgroup>
	<tr class="totals">
		<th scope="col">Items to buy now</th>
		<th scope="col"></th>
		<th class="money" colspan="2">Price</th>
	</tr>

	<?php while(shopp('cart','items')): ?>
		<tr>
			<td><?php shopp('cartitem','coverimage','size=112'); ?></td>
			<td class="vat">
				
				<a href="<?php shopp('cartitem','url'); ?>" class="pm-cart-product-title"><?php shopp('cartitem','name'); ?></a>
				<?php shopp('cartitem', 'description'); ?>
				<?php shopp('cartitem','options'); ?>
				<?php shopp('cartitem','addons-list'); ?>
				<?php shopp('cartitem','inputs-list'); ?>
				<?php shopp('cartitem','remove','label=Delete'); ?>
			</td>
			<td class="vat money" colspan="2"><?php shopp('cartitem','total'); ?></td>
		</tr>
	<?php endwhile; ?>

	<?php while(shopp('cart','promos')): ?>
		
		<tr><td colspan="4" class="money"><?php shopp('cart','promo-name'); ?><strong><?php shopp('cart','promo-discount',array('before' => '&nbsp;&mdash;&nbsp;')); ?></strong></td></tr>
	<?php endwhile; ?>

	<tr class="totals">
		
		<td colspan="2" rowspan="5">
			<?php if (shopp('cart','needs-shipping-estimates')): ?>
			<small>Estimate shipping &amp; taxes for:</small>
			<?php shopp('cart','shipping-estimates'); ?>
			<?php endif; ?>
			<label class="pm-pc">Promo Code:</label>
			<?php shopp('cart','promo-code','class=promo-input&value=Apply'); ?>
		</td>
		<th scope="row" class="bt">Subtotal</th>
		<td class="money bt"><?php shopp('cart','subtotal'); ?></td>
	</tr>
	<?php if (shopp('cart','hasdiscount')): ?>
	<tr class="totals">
		<th scope="row">Discount</th>
		<td class="money">-<?php shopp('cart','discount'); ?></td>
	</tr>
	<?php endif; ?>
	<?php if (shopp('cart','needs-shipped')): ?>
	<tr class="totals">
		<th scope="row"><?php shopp('cart','shipping','label=Estimated Shipping'); ?></th>
		<td class="money"><?php shopp('cart','shipping'); ?></td>
	</tr>
	<?php endif; ?>
	<tr class="totals">
		<th scope="row"><?php shopp('cart','tax','label=Tax'); ?></th>
		<td class="money"><?php shopp('cart','tax'); ?></td>
	</tr>
	<tr class="totals total">
		<th scope="row">Total</th>
		<td class="money"><?php shopp('cart','total'); ?></td>
	</tr>
</table>


<a href="<?php shopp('checkout','url'); ?>" class="right pm-proceed-checkout">Proceed to Checkout</a>


</form>

<?php else: ?>
	<p class="warning">There are currently no items in your shopping cart.</p>
	<p><a href="<?php shopp('catalog','url'); ?>">&laquo; Continue Shopping</a></p>
<?php endif; ?>