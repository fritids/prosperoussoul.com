<h3>My Media</h3>
<section class="pm-account">

<?php
$ordered_products = array();
$product_images = array();

if (shopp('customer', 'has-purchases')) {
	while (shopp('customer','purchases')) {
		if (shopp('purchase', 'paid')) {
			if (shopp('purchase', 'has-items')) {
				while (shopp('purchase', 'items')) {
					$product_id = strval(intval(shopp('purchase', 'get-item-id')));
					$row = $wpdb->get_row('SELECT product FROM ' . $wpdb->prefix . 'shopp_purchased WHERE id = ' . $product_id, ARRAY_N);
					$ordered_products[] = $row[0];
					shopp('storefront', 'product', array('id' => $row[0], 'load' => true));
					if (shopp('product', 'found')) {
						$product_images[$row[0]] = shopp('product', 'get-image', array('width' => 100, 'height' => 100, 'property' => 'url'));
					}
				}
			}
		}
	}
}

$products_query = new WP_Query(array(
	'post_type' => 'prosperous_media',
	'meta_key' => 'pm_shopp_links',
	'orderby' => 'title',
	'order' => 'ASC',
));

while ($products_query->have_posts()):

	$products_query->the_post();
	$linked_product_ids = array();
	$pm_shopp_links = get_post_meta(get_the_id(), 'pm_shopp_links');
	if (isset($pm_shopp_links[0]))
		$linked_product_ids = $pm_shopp_links[0];

	foreach ($linked_product_ids as $linked_product_id):
		if (in_array($linked_product_id, $ordered_products)):

			$pdf_url = '';
			$pdf_meta = get_post_meta(get_the_id(), 'pm_pdf');
			if (isset($pdf_meta[0]))
				$pdf_url = wp_get_attachment_url($pdf_meta[0]);

			$image_url = $product_images[$linked_product_id] ? $product_images[$linked_product_id] : get_bloginfo('url') . '/wp-content/uploads/2011/07/placeholder-100x80.png';
?>

	<article class="mymedia-item clearfix">
		<div class="mymedia-product-img">
			<img src="<?php echo $image_url; ?>" alt="Product Title">
		</div>
		
		<div class="mymedia-product-info">
			<h3><?php the_title(); ?></h3>
			<p><?php
			$content = get_the_content();
			if (strlen($content) > 120) {
				echo substr($content, 0, 117) . '...';
			} else {
				echo $content;
			}
			?></p>
		</div>
		<ul class="mymedia-actions">
			<li><a href="<?php the_permalink(); ?>" class="btn">View Now</a></li>
			<?php if ($pdf_url): ?>
			<li><a href="<?php echo $pdf_url; ?>">Download PDF</a></li>
			<?php endif; ?>
		</ul>
	</article>

<?php
		endif;
	endforeach;
endwhile;
?>

</section>

<?php include('pm-menu.php') ?>
