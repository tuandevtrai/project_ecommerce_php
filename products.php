<?php require 'inc/header.php';
require 'inc/slider.php';
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>LAPTOP</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$get_product_laptop = $product->get_product_laptop();
			if ($get_product_laptop) {
				while ($result_laptop = $get_product_laptop->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="./admin/uploads/<?php echo $result_laptop['image'] ?>" /></a>
						<h2><?= $result_laptop['productName'] ?></h2>
						<p><?= $fm->textShorten(($result_laptop['productDesc']), 20)  ?></p>
						<p><span class="price"><?= $fm->format_currency($result_laptop['price']) . " VND" ?></span></p>
						<div class="button"><span><a href="details.php?productId=<?= $result_laptop['productId'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_top">
			<div class="heading">
				<h3>SOUNDS</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$get_product_sounds = $product->get_product_sounds();
			if ($get_product_sounds) {
				while ($result_sounds = $get_product_sounds->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="./admin/uploads/<?php echo $result_sounds['image'] ?>" /></a>
						<h2><?= $result_sounds['productName'] ?></h2>
						<p><?= $fm->textShorten(($result_sounds['productDesc']), 20)  ?></p>
						<p><span class="price"><?= $fm->format_currency($result_sounds['price']) . " VND" ?></span></p>
						<div class="button"><span><a href="details.php?productId=<?= $result_sounds['productId'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_top">
			<div class="heading">
				<h3>CHAIRS</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$get_product_chairs = $product->get_product_chairs();
			if ($get_product_chairs) {
				while ($result_chairs = $get_product_chairs->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="./admin/uploads/<?php echo $result_chairs['image'] ?>" /></a>
						<h2><?= $result_chairs['productName'] ?></h2>
						<p><?= $fm->textShorten(($result_chairs['productDesc']), 20)  ?></p>
						<p><span class="price"><?= $fm->format_currency($result_chairs['price']) . " VND" ?></span></p>
						<div class="button"><span><a href="details.php?productId=<?= $result_chairs['productId'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>
<?php require 'inc/footer.php' ?>