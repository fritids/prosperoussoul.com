<?php
$current_id = shopp('product', 'get-id');

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
<?php if (shopp('cart','hasitems')): ?>
	<hr>
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
<?php shopp('storefront', 'product', array('id' => $current_id, 'load' => true)); ?>
<?php shopp('catalog','breadcrumb')?>
<?php if (shopp('product','found')): ?>

	<?php shopp('product','gallery','p_setting=gallery-previews&thumbsetting=gallery-thumbnails'); ?>

	<h3><?php shopp('product','name'); ?></h3>
	<p class="headline"><big><?php shopp('product','summary'); ?></big></p>

	<?php if (shopp('product','onsale')): ?>
		<h3 class="original price"><?php shopp('product','price'); ?></h3>
		<h3 class="sale price"><?php shopp('product','saleprice'); ?></h3>
		<?php if (shopp('product','has-savings')): ?>
			<p class="savings">You save <?php shopp('product','savings'); ?> (<?php shopp('product','savings','show=%'); ?>)!</p>
		<?php endif; ?>
	<?php else: ?>
		<h3 class="price"><?php shopp('product','price'); ?></h3>
	<?php endif; ?>

	<?php if (shopp('product','freeshipping')): ?>
	<p class="freeshipping">Free Shipping!</p>
	<?php endif; ?>
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
	<div class="woo-sc-box alert" style="clear: both;">Already purchased: <a href="<?php bloginfo('url'); ?>/pm/account/" class="button">View in My Media.</a></div>
	<?php else: ?>
	<form action="<?php shopp('cart','url'); ?>" method="post" class="shopp product validate validation-alerts">
		<?php if(shopp('product','has-variations')): ?>
		<ul class="variations">
			<?php shopp('product','variations','mode=multiple&label=true&defaults=Select an option&before_menu=<li>&after_menu=</li>'); ?>
		</ul>
		<?php endif; ?>
		<?php if(shopp('product','has-addons')): ?>
			<ul class="addons">
				<?php shopp('product','addons','mode=menu&label=true&defaults=Select an add-on&before_menu=<li>&after_menu=</li>'); ?>
			</ul>
		<?php endif; ?>

		<p><?php shopp('product','addtocart'); ?></p>
	</form>
	<?php endif; ?>

	<?php shopp('product','description'); ?>

	<?php if(shopp('product','has-specs')): ?>
	<dl class="details">
		<?php while(shopp('product','specs')): ?>
		<dt><?php shopp('product','spec','name'); ?>:</dt><dd><?php shopp('product','spec','content'); ?></dd>
		<?php endwhile; ?>
	</dl>
	<?php endif; ?>

<?php else: ?>
<h3>Product Not Found</h3>
<p>Sorry! The product you requested is not found in our catalog!</p>
<?php endif; ?>
