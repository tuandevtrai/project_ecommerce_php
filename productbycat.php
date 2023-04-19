<?php require 'inc/header.php';
//require 'inc/slider.php';
?>
<?php
if (!isset($_GET['catId']) || $_GET['catId'] == null) {
	echo "<script>window.location='404.php'</script>";
} else {
	$catId = $_GET['catId'];
}
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <?php
			$get_cat_name = $cat->get_name_by_cat($catId);
			$check_empty_in_cart = $cat->check_empty_in_cart($catId);
			if ($get_cat_name) {
				while ($resultcatname = $get_cat_name->fetch_assoc()) {
			?>
            <div class="heading">
                <h3>Category: <?php echo $resultcatname['catName']  ?></h3>
                <?php
				}
			}
				?>
                <div class="clear"></div><br/>
				<?php
					if (($check_empty_in_cart) == false) { ?>
							<span style="font-size:18px">Category is empty</span>
					<?php
					}
					?>
            </div>

            <div class="section group">
                <?php
						$productbycat = $cat->get_product_by_cat($catId);
						if ($productbycat) {
							while ($result = $productbycat->fetch_assoc()) {
						?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php"><img src="./admin/uploads/<?php echo $result['image'] ?>" /></a>
                    <h2><?php echo $result['productName'] ?> </h2>
                    <p><?php echo $fm->textShorten($result['productDesc'], 200) ?></p>
                    <p><span class="price"><?php echo $fm->format_currency($result['price']) ." đ" ?></span></p>
                    <div class="button"><span><a href="details.php?productId=<?php echo $result['productId'] ?>"
                                class="details">Details</a></span></div>
                </div>
                <?php
							}
						}
						?>
            </div>



        </div>
    </div>
    <?php require 'inc/footer.php' ?>