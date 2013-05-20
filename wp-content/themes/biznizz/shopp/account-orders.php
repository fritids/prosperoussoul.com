<section class="pm-account">

<h3>My Orders</h3>
<?php if (shopp('purchase','get-id')): ?>
	<?php shopp('purchase','receipt'); ?>
<?php return; endif; ?>

<form action="<?php shopp('customer','action'); ?>" method="post" class="shopp validate" autocomplete="off">

<?php if (shopp('customer','has-purchases')): ?>
	<table cellspacing="0" cellpadding="0" class="pm-order-list">
		<colgroup>
			<col class="col-1"/>
			<col class="col-2" />
			<col class="col-3"/>
			<col class="col-4"/>
		</colgroup>
		<thead>
			<tr class="tac">
				<th scope="col" class="tal">Date</th>
				<th scope="col">Order</th>
				<th scope="col">Status</th>
				<th scope="col">Total</th>
			</tr>
		</thead>
		<?php while(shopp('customer','purchases')): ?>
		<tr class="tac">
			<td class="tal"><?php shopp('purchase','date'); ?></td>
			<td>#<?php shopp('purchase','id'); ?></td>
			<td><?php shopp('purchase','status'); ?></td>
			<td><?php shopp('purchase','total'); ?></td>
			<td><a href="<?php shopp('customer','order'); ?>">View Order</a></td>
		</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
<p>You have no orders, yet.</p>
<?php endif; // end 'has-purchases' ?>

</form>
</section>
<?php include('pm-menu.php') ?>
