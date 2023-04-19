<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php')
?>

<?php

$cart = new cart();
if (isset($_GET['penddingId'])) {
	$id = $_GET['penddingId'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$pendding = $cart->pendding($id, $time, $price);
}
// if (isset($_GET['shiftingId'])) {
// 	$id = $_GET['shiftingId'];
// 	$time = $_GET['time'];
// 	$price = $_GET['price'];
// 	$shifting = $cart->shifting($id, $time, $price);
// }
if (isset($_GET['delId'])) {
	$id = $_GET['delId'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$del_Shifted = $cart->del_shifted($id, $time, $price);
}

?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<div class="block">
			<?php
			if (isset($pendding)) {
				echo $pendding;
			}
			if (isset($shifting)) {
				echo $shifting;
			}
			if (isset($del_Shifted)) {
				echo $del_Shifted;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Order Time</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Customer ID</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$cart = new cart();
					$fm = new Format();
					$get_inbox_cart = $cart->get_inbox_cart();
					if ($get_inbox_cart) {
						$id = 0;
						while ($result = $get_inbox_cart->fetch_assoc()) {
							$id++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $id; ?></td>
								<td><?php echo $fm->formatDate($result['date_order'])  ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['quantity']?></td>
								<td><?php echo $fm->format_currency($result['price']) . " đ" ?></td>
								<td><?php echo $result['customerId'] ?></td>
								<td><a href="customer.php?customerId=<?php echo $result['customerId'] ?>">View Customer</a></td>
								<td>
									<?php
									if ($result['status'] == 0) {
									?>
										<a href="?penddingId=<?php echo $result['id'] ?> &price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Pending...</a>

									<?php
									} else if ($result['status'] == 1) { ?>
										<?php echo 'waiting customer confirm' ?>
									<?php
									} else {
									?>
										<a href="?delId=<?php echo $result['id'] ?> &price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Remove</a>
									<?php
									}
									?>
								</td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>