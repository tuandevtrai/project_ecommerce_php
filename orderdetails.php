<?php require 'inc/header.php';
//require 'inc/slider.php';
?>
<?php
// if (isset($_GET['cartId'])) {
// 	$id = $_GET['cartId'];
// 	$del_in_cart = $cart->del_in_cart($id);
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
// 	$cartId = $_POST['cartId'];
// 	$quantity = $_POST['quantity'];
// 	$update_quantity_cart = $cart->update_quantity_cart($quantity, $cartId);
// 	if ($quantity <= 0) {
// 		echo $del_in_cart = $cart->del_in_cart($cartId);
// 	}
// }
?>
<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('location:login.php');
}
$cart = new cart();
if (isset($_GET['confirmId'])) {
	$id = $_GET['confirmId'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$shifted_confirm = $cart->shifted_confirm($id, $time, $price);
}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2 style="width:100%">Your Detail Ordered</h2>
				<?php
				if (isset($shifted_confirm)) {
					echo $shifted_confirm;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="10%">ID</th>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="10%">Quantity</th>
						<th width="10%">Total Price</th>
						<th width="20%">Date</th>
						<th width="15%">Status</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$customerId = Session::get('customer_id');
					$get_cart_ordered = $cart->get_cart_ordered($customerId);
					if ($get_cart_ordered) {
						$id = 0;
						$price_order = 0;
						while ($result = $get_cart_ordered->fetch_assoc()) {
							$id++;
					?>
							<tr>
								<td><?= $id ?></td>
								<td><?= $result['productName'] ?></td>
								<td><img src="admin/uploads/<?=  $result['image'] ?>" height="100px"  /></td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?= $fm->format_currency($result['price']) . " đ" ?></td>
								<td><?php echo $fm->formatDate($result['date_order']) ?></td>
								<td><?php
									if ($result['status'] == 0) {
										echo 'Pending';
									} else if ($result['status'] == 1) { ?>
										<span>Shifting</span>
									<?php
									} else if ($result['status'] == 2) {
										echo 'Received';
									}
									?>
								</td>
								<?php
								if ($result['status'] == 0) {
								?>
									<td><?php echo 'N/A'; ?></td>
								<?php
								} else if ($result['status'] == 1) {
								?>
									<td><a href="?confirmId=<?php echo $customerId ?>&price=<?php echo $result['price'] ?>  &time=<?php echo $result['date_order'] ?>">Shifted complete</a></td>
								<?php } else {
								?>
									<td><?php echo 'Received' ?></td>
								<?php }
								?>

								<?php

								?>
							</tr>
					<?php
							$price_order += $result['price'];
						}
					}
					?>

				</table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php require 'inc/footer.php' ?>