<?php require 'inc/header.php';
//require 'inc/slider.php';
?>
<?php
if (!isset($_GET['productId']) || $_GET['productId'] == null) {
    echo "<script>window.location='404.php'</script>";
} else {
    $productId = $_GET['productId'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $addToCart = $cart->add_to_cart($productId, $quantity);
}
$customerId = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
    $productId = $_POST['productId'];
    $insert_compare = $product->insert_compare($productId, $customerId);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
    $productId = $_POST['productId'];
    $insert_wishlist = $product->insert_wishlist($productId, $customerId);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_submit'])) {
    $productId = $_POST['product_id_comment'];
    $tenbinhluan = $_POST['tennguoibinhluan'];
    $binhluan = $_POST['binhluan'];
    $insert_comment = $comment->insert_comment($productId, $tenbinhluan, $binhluan);
}

?>
<div class="main">
    <div class="content">
        <?php
        if (isset($insert_compare)) {
            echo $insert_compare;
        }
        if (isset($insert_wishlist)) {
            echo $insert_wishlist;
        }
        if (isset($insert_comment)) {
            echo $insert_comment;
        }
        ?>
        <div class="section group">
            <?php
            $get_product_details = $product->get_details($productId);
            if ($get_product_details) {
                while ($result_details = $get_product_details->fetch_assoc()) {
            ?>
                    <div class="cont-desc span_1_of_2">
                        <div class="grid images_3_of_2">
                            <img src="./admin/uploads/<?php echo $result_details['image'] ?>" />
                        </div>
                        <div class="desc span_3_of_2">
                            <h2><?= $result_details['productName'] ?></h2>
                            <p><?= $fm->textShorten($result_details['productDesc'], 200) ?></p>
                            <div class="price">
                                <p>Price: <span><?= $fm->format_currency($result_details['price']) . " VND" ?></span></p>
                                <p>Category: <span><?= $result_details['catName'] ?></span></p>
                                <p>Brand:<span><?= $result_details['brandName'] ?></span></p>
                            </div>
                            <div class="add-cart">
                                <form action="" method="post">
                                    <input type="number" class="buyfield" name="quantity" value="1" min="1" />
                                    <input type="submit" class="buysubmit" name="submit" value="Buy Now" />
                                    <?php
                                    if (isset($addToCart)) {
                                        echo '<span style="color:red";font-size:18px>Product already added</span>';
                                    }
                                    ?>
                                </form>
                            </div>
                            <?php
                            $customerLogin = Session::get('customer_login');
                            if ($customerLogin == true) { ?>
                                <div class="add-cart">
                                    <form action="" method="post">
                                        <input type="hidden" class="buysubmit" name="productId" value="<?php echo  $result_details['productId']  ?>" />
                                        <input type="submit" class="buysubmit" name="compare" value="Compare product" />
                                    </form><br />
                                    <form action="" method="post">
                                        <input type="hidden" class="buysubmit" name="productId" value="<?php echo  $result_details['productId']  ?>" />
                                        <input type="submit" class="buysubmit" name="wishlist" value="Save to wishlist" />
                                    </form>
                                </div>
                            <?php
                            } else {
                                echo null;
                            }
                            ?>

                        </div>
                        <div class="product-desc">
                            <h2>Product Details</h2>
                            <p><?= $result_details['productDesc'] ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <?php
                $cat_list = new category();
                $show_cat_list = $cat_list->show_category_frontend();
                if ($show_cat_list) {
                    while ($result = $show_cat_list->fetch_assoc()) {
                ?>
                        <ul>
                            <li><a href="productbycat.php?catId=<?php echo $result['catId'] ?>"><?= $result['catName'] ?></a></li>
                        </ul>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="binhluan">
            <div class="row">
                <div class="col-md-8">
                    <h5>Bình luận về sản phẩm</h5>
                    <form action="" method="post">
                        <p><input type="hidden" value="<?php echo $productId ?>" name="product_id_comment" /></p>
                        <p><input type="text" placeholder="Điền tên" class="form-control" name="tennguoibinhluan" /></p>
                        <p><textarea rows="5" style="resize:none" placeholder="Bình luận......." class="form-control" name="binhluan"></textarea></p>
                        <p><input type="submit" name="comment_submit" class="btn btn-success" value="Gửi bình luận" /></p>
                    </form>

                </div>
            </div>
        </div>
        <div class="binhluan">
            <h5>Bình luận của khách hàng khác</h5>
            <?php

            $comment = $comment->show_comment($productId);
            if ($comment) {
                while ($result = $comment->fetch_assoc()) {
            ?>
                    <div class="row">
                        <div class="col-md-8">
                            <label type="text" class="form-control"> <?php echo $result['detailComment'] ?></label>
                        </div>
                       
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php require 'inc/footer.php' ?>