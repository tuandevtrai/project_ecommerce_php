<?php require 'inc/header.php';
//require 'inc/slider.php';
?>
<?php
$customerId=Session::get('customer_id');
if (isset($_GET['productId'])) {
	$id = $_GET['productId'];
	$show_product = $product->show_product($id,$customerId);
}


?>
<?php
	// if(!isset($_GET['id'])){
	// 	echo "<meta http-equiv='refresh' content='0;URL=?id=live' >";
	// }
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2 style="width:100%">Compare Product</h2>
				<table class="tblone">
					<tr>
						<th width="10%">ID compare</th>
						<th width="20%">Product Name</th>
						<th width="20%">Image</th>
						<th width="15%">Price</th>
						<th width="15%">Action</th>
					</tr>
					<?php
					$customerId=Session::get('customer_id');
					$get_compare = $cart->get_compare($customerId);
					if ($get_compare) {
						$id=0;
						while ($result = $get_compare->fetch_assoc()) {
							$id++;
					?>
							<tr>
								<td><?= $id ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>"/></td>
								<td><?php echo $fm->format_currency($result['price']). " đ" ?></td>
								<td><a href="details.php?productId=<?php echo $result['productId'] ?>">View</a></td>
							</tr>
					<?php
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

