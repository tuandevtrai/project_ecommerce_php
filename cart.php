<?php require 'inc/header.php';
//require 'inc/slider.php';
?>
<?php
if (isset($_GET['cartId'])) {
	$id = $_GET['cartId'];
	$del_in_cart = $cart->del_in_cart($id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$cartId = $_POST['cartId'];
	$productQuantity=$_POST['productQuantity'];
	$quantity = $_POST['quantity'];
	$update_quantity_cart = $cart->update_quantity_cart($productQuantity,$quantity, $cartId);
	if ($quantity <= 0) {
		echo $del_in_cart = $cart->del_in_cart($cartId);
	}
}
?>
<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live' >";
	}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>
				<?php
				if (isset($update_quantity_cart)) {
					echo $update_quantity_cart;
				}
				if (isset($del_in_cart)) {
					echo $del_in_cart;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="10%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="15%">Product Quantity</th>
						<th width="25%">Quantity</th>
						
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$get_product_cart = $cart->get_product_cart();
					if ($get_product_cart) {
						$subTotal = 0;
						$qty = 0;
						while ($result = $get_product_cart->fetch_assoc()) {
					?>
							<tr>
								<td><?= $result['productName'] ?></td>
								<td><img src="./admin/uploads/<?= $result['image'] ?>" alt="" height="100px" /></td>
								<td><?= $fm->format_currency($result['price']). " đ" ?></td>
								<td><?php echo $result['productQuantity'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?= $result['cartId'] ?>" />
										<input type="hidden" name="productQuantity" value="<?php echo $result['productQuantity'] ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity'] ?>" min="1" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								

								<td><?php $total = $result['price'] * $result['quantity'];
									echo $fm->format_currency($total) . " đ" ?></td>
								<td><a href="?cartId=<?= $result['cartId'] ?>">Xóa</a></td>
							</tr>
					<?php
							$subTotal += $total;
							$qty = $qty + $result['quantity'];
						}
					}
					?>
				</table>
				<?php

				$check_cart = $cart->check_cart();
				if ($check_cart) {
				?>
					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Sub Total : </th>
							<td><?php

								echo $fm->format_currency($subTotal) . " VND";
								Session::set('sum', $subTotal);
								Session::set('qty', $qty);
								?></td>
						</tr>
						<tr>
							<th>VAT : </th>
							<td>10%</td>
						</tr>
						<tr>
							<th>Grand Total :</th>
							<td><?php
								$vat = $subTotal * 0.1;
								$gtotal = $subTotal + $vat;
								echo $fm->format_currency($gtotal) . " VND";
								?> </td>
						</tr>
					</table>
				<?php
				}else{
					echo 'Your cart is empty! Please shopping now';
				}
				?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php require 'inc/footer.php' ?>