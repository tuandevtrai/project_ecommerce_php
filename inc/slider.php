<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
			$getLastestDell = $product->getLastestKeyboard();
			if ($getLastestDell) {
				while ($resultDell = $getLastestDell->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img src="admin/uploads/<?php echo $resultDell['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $resultDell['productName'] ?></h2>
							<p><?= $fm->textShorten($resultDell['productDesc'],100)  ?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo $resultDell['productId'] ?>">Details</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<?php
			$getLastestHp = $product->getLastestLaptop();
			if ($getLastestHp) {
				while ($resultHp = $getLastestHp->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"><img src="admin/uploads/<?php echo $resultHp['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?= $resultHp['productName'] ?></h2>
							<p><?= $fm->textShorten($resultHp['productDesc'],100) ?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo $resultHp['productId'] ?>">Details</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="section group">
			<?php
			$getLastestSamSung = $product->getLastestMarshall();
			if ($getLastestSamSung) {
				while ($resultSamSung = $getLastestSamSung->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img src="admin/uploads/<?php echo $resultSamSung['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?= $resultSamSung['productName'] ?></h2>
							<p><?= $fm->textShorten($resultSamSung['productDesc'],100) ?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo $resultSamSung['productId'] ?>">Details</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<?php
			$getLastestApple = $product->getLastestChair();
			if ($getLastestApple) {
				while ($resultApple = $getLastestApple->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img src="admin/uploads/<?php echo $resultApple['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?= $resultApple['productName'] ?></h2>
							<p><?= $fm->textShorten($resultApple['productDesc'],50) ?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo $resultApple['productId'] ?>">Details</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="header_bottom_right_images">
		<!-- FlexSlider -->

		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<?php
					$slider=new slider();
					$show_slider = $slider->show_slider();
					if (isset($show_slider)) {
						while ($result = $show_slider->fetch_assoc()) {
					?>
							<li><img src="admin/uploads/<?php echo $result['image'] ?>" alt="<?php echo $result['sliderName'] ?>" width="270" height="318"/></li>
					<?php
						}
					}
					?>
				</ul>
			</div>
		</section>
		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>