<?php require_once 'inc/header.php';
require_once 'inc/slider.php';
?>
<div class="main">
	<?php
		//echo session_id();
	?>
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$getproduct = $product->getproduct_featured();
			if ($getproduct) {
				while ($result = $getproduct->fetch_assoc()) 
				{
			?>
					<div class="grid_1_of_4 images_1_of_4" >
						<a href="details.php"><img src="./admin/uploads/<?php echo $result['image'] ?>"/></a>
						<h2><?= $result['productName'] ?></h2>
						<p><span class="price"><?= $fm->format_currency($result['price']) . " VND" ?></span></p>
						<div class="button"><span><a href="details.php?productId=<?= $result['productId'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			  $product_new = $product->getproduct_new();
			  if ($product_new) {
			  	while ($result_new = $product_new->fetch_assoc()) {
			  ?>
			  		<div class="grid_1_of_4 images_1_of_4">
			  			<a href="details.php"><img src="./admin/uploads/<?php echo $result_new['image'] ?>"/></a>
			  			<h2><?= $result_new['productName'] ?> </h2>
	 		 			<p><span class="price"><?= $fm->format_currency($result_new['price'])." VND" ?></span></p>
			  			<div class="button"><span><a href="details.php?productId=<?= $result_new['productId']?>" class="details">Details</a></span></div>
			  		</div>
			<?php
				}
			}
				?>
		</div>
		
		<div class="">
			<?php
				 $product_all=$product->get_all_product();
				 $product_count=mysqli_num_rows($product_all);
				 $product_button=ceil($product_count/4);
				 for($i=1;$i<=$product_button;$i++){
					echo '<a style="margin:0 5px" href="index.php?Trang='.$i.'">Trang '.$i.'</a>';
				 }
			?>
		</div>
	</div>
</div>
<?php require 'inc/footer.php' ?>