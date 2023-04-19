<?php require 'inc/header.php';
//require 'inc/slider.php';
?>

<div class="main">
    <div class="content">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tukhoa = $_POST['tukhoa'];
            $searching_product = $product->searching_product($tukhoa);
        }
        ?>
        <div class="content_top">

            <div class="heading">
                <h3>Tìm kiếm tìm kiếm: <?php echo $tukhoa ?></h3>
                <div class="clear"></div><br/>
            </div>

            <div class="section group">
                <?php
                
                if ($searching_product) {
                    while ($result = $searching_product->fetch_assoc()) {
                ?>
                        <div class="grid_1_of_4 images_1_of_4">
                            <a href="details.php"><img src="./admin/uploads/<?php echo $result['image'] ?>" /></a>
                            <h2><?php echo $result['productName'] ?> </h2>
                            <p><?php echo $fm->textShorten($result['productDesc'], 200) ?></p>
                            <p><span class="price"><?php echo $fm->format_currency($result['price']) . " đ" ?></span></p>
                            <div class="button"><span><a href="details.php?productId=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>



        </div>
    </div>
    <?php require 'inc/footer.php' ?>