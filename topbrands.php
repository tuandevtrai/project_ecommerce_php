<?php require 'inc/header.php';
require 'inc/slider.php';
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Dell</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$get_product_dell = $product->get_product_dell();
			if ($get_product_dell) {
				while ($result_dell = $get_product_dell->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="./admin/uploads/<?php echo $result_dell['image'] ?>" /></a>
						<h2><?= $result_dell['productName'] ?></h2>
						<p><?= $fm->textShorten(($result_dell['productDesc']), 20)  ?></p>
						<p><span class="price"><?= $fm->format_currency($result_dell['price']) . " VND" ?></span></p>
						<div class="button"><span><a href="details.php?productId=<?= $result_dell['productId'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_top">
			<div class="heading">
				<h3>MARSHALL</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$get_product_marshall = $product->get_product_marshall();
			if ($get_product_marshall) {
				while ($result_marshall = $get_product_marshall->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="./admin/uploads/<?php echo $result_marshall['image'] ?>" /></a>
						<h2><?= $result_marshall['productName'] ?></h2>
						<p><?= $fm->textShorten(($result_marshall['productDesc']), 20)  ?></p>
						<p><span class="price"><?= $fm->format_currency($result_marshall['price']) . " VND" ?></span></p>
						<div class="button"><span><a href="details.php?productId=<?= $result_marshall['productId'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_top">
			<div class="heading">
				<h3>AKKO</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$get_product_akko = $product->get_product_akko();
			if ($get_product_akko) {
				while ($result_akko = $get_product_akko->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="./admin/uploads/<?php echo $result_akko['image'] ?>" /></a>
						<h2><?= $result_akko['productName'] ?></h2>
						<p><?= $fm->textShorten(($result_akko['productDesc']), 20)  ?></p>
						<p><span class="price"><?= $fm->format_currency($result_akko['price']) . " VND" ?></span></p>
						<div class="button"><span><a href="details.php?productId=<?= $result_akko['productId'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>
<?php require 'inc/footer.php' ?>