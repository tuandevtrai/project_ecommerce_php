<?php require 'inc/header.php';
//require 'inc/slider.php';
?>
<?php
$customerId=Session::get('customer_id');
// if (isset($_GET['productId'])) {
// 	$id = $_GET['productId'];
// 	$show_product = $product->show_product($id,$customerId);
// }
if(isset($_GET['delproductId'])){
	$delId=$_GET['delproductId'];
	$del_in_wishlist=$wishlist->del_in_wishlist($delId,$customerId);
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
				<h2>Wish List</h2>
				<?php
				if (isset($del_in_wishlist)) {
					echo $del_in_wishlist;
				}
				?>
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
					$get_wishlist = $cart->get_wishlist($customerId);
					if ($get_wishlist) {
						$id=0;
						while ($result = $get_wishlist->fetch_assoc()) {
							$id++;
					?>
							<tr>
								<td><?= $id ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>"/></td>
								<td><?php echo $fm->format_currency($result['price'])." đ" ?></td>
								<td>
									<a href="?delproductId=<?php echo $result['productId'] ?>">Delete</a> ||
									<a href="details.php?productId=<?php echo $result['productId'] ?>">Buy</a> 
								</td>
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