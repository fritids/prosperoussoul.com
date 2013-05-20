<?php if (shopp('customer','notloggedin')): ?>
<div class="woo-sc-box info">	
	<p class="big">To get started simply make a purchase.  You'll create your account in the checkout process.  Once you've made a purchase the item will show up in your account under My Media.</p>
</div>
	<?php endif; ?>
<hr>

<?php if (shopp('cart','hasitems')): ?>
<div id="shopp-cart-ajax">
	<p class="status">
		<span>Your Cart: </span>
		<span id="shopp-sidecart-items"><?php shopp('cart','totalitems'); ?></span> <strong>Items</strong> <a href="<?php shopp('cart','url'); ?>">[Edit]</a> | 
		<span id="shopp-sidecart-total" class="money"><?php shopp('cart','total'); ?></span> <strong>Total</strong>
			<?php if (shopp('checkout','local-payment')): ?>
		<a href="<?php shopp('checkout','url'); ?>" class="button">Checkout</a>
	</p>
<?php else: ?>
	<p class="status">Your cart is empty.</p>
<?php endif; ?>
</div>
<hr>
<?php endif; ?>

<?php if(shopp('category','hasproducts','load=coverimages')): ?>
	<div class="category">
	
	<?php shopp('catalog','views','label=Views: '); ?>

	<?php shopp('catalog','category-list','dropdown=on'); ?>
	<div class="alignright"><?php shopp('category','pagination','show=10'); ?></div>

	<ul class="products">
<?php
$purchased_products = array();
$purchased_tags = array();

if (shopp('customer', 'has-purchases')) {
	while (shopp('customer','purchases')) {
		if (shopp('purchase', 'paid')) {
			if (shopp('purchase', 'has-items')) {
				while (shopp('purchase', 'items')) {
					$product_id = strval(intval(shopp('purchase', 'get-item-id')));
					$row = $wpdb->get_row('SELECT product FROM ' . $wpdb->prefix . 'shopp_purchased WHERE id = ' . $product_id, ARRAY_N);
					$purchased_products[] = $row[0];

					shopp('storefront', 'product', array('id' => $row[0], 'load' => 'categories,tags'));
					if (shopp('product', 'found')) {
						if (shopp('product', 'in-category', array('slug' => 'video-bundles'))) {
							if (shopp('product', 'has-tags')) {
								while (shopp('product', 'tags')) {
									$purchased_tags[] = strtolower(shopp('product', 'get-tag'));
								}
							}
						}
					}
				}
			}
		}
	}
}
?>
		<li class="row"><ul>
		<?php while(shopp('category','products')): ?>
		<?php if(shopp('category','row')): ?></ul></li><li class="row"><ul><?php endif; ?>
			<li class="product">
				<div class="frame">
				<a href="<?php shopp('product','url'); ?>"><?php shopp('product','coverimage','setting=thumbnails'); ?></a>
					<div class="details">
					<h4 class="name"><a href="<?php shopp('product','url'); ?>"><?php shopp('product','name'); ?></a></h4>
					<p class="price"><?php shopp('product','saleprice','starting=from'); ?> </p>
					<?php if (shopp('product','has-savings')): ?>
						<p class="savings">Save <?php shopp('product','savings','show=percent'); ?></p>
					<?php endif; ?>

						<div class="listview">
						<p><?php shopp('product','summary'); ?></p>
						<?php
$in_tags = false;
if (shopp('product', 'has-tags')) {
	while (shopp('product', 'tags')) {
		if (in_array(strtolower(shopp('product', 'get-tag')), $purchased_tags)) {
			$in_tags = true;
		}
	}
}
?>
						<?php if (in_array(shopp('product', 'get-id'), $purchased_products) || $in_tags): ?>
							<div class="woo-sc-box alert">Already purchased: <a href="<?php bloginfo('url'); ?>/pm/account/" class="button">View in My Media.</a></div>
						<?php else: ?>
							<form action="<?php shopp('cart','url'); ?>" method="post" class="shopp product">
							<?php shopp('product','addtocart'); ?>
							</form>
						<?php endif; ?>
						</div>
					</div>

				</div>
			</li>
		<?php endwhile; ?>
		</ul></li>
	</ul>

	<div class="alignright"><?php shopp('category','pagination','show=10'); ?></div>

	</div>
<?php else: ?>
	<?php if (!shopp('catalog','is-landing')): ?>
	<?php shopp('catalog','breadcrumb'); ?>
	<h3><?php shopp('category','name'); ?></h3>
	<p>No products were found.</p>
	<?php endif; ?>
<?php endif; ?>
