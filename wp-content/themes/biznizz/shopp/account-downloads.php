<section class="pm-account">
<h3>My Downloads</h3>
<?php if (shopp('customer','has-downloads')): ?>
<table cellspacing="0" cellpadding="0" class="pm-download-list">
	<colgroup>
		<col class="col-1"/>
		<col class="col-2" />
		<col class="col-3"/>
	</colgroup>
	<thead>
		<tr class="tac">
			<th scope="col" class="tal">Product</th>
			<th scope="col">Order</th>
			<th scope="col">Amount</th>
		</tr>
	</thead>
	<?php while(shopp('customer','downloads')): ?>
	<tr class="tac">
		<td class="tal"><?php shopp('customer','download','name'); ?><br />
			<a href="<?php shopp('customer','download','url'); ?>" class="button">Download File</a></td>
		<td><?php shopp('customer','download','date'); ?></td>
		<td><?php shopp('customer','download','total'); ?></td>
	</tr>
	<?php endwhile; ?>
</table>
<?php else: ?>
<p>You have no digital product downloads available.</p>
<?php endif; // end 'has-downloads' ?>
</section>
<?php include('pm-menu.php') ?>
