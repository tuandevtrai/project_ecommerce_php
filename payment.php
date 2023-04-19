<?php require 'inc/header.php';
//require 'inc/slider.php';
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('location:login.php');
} else {
}

// if (!isset($_GET['productId']) || $_GET['productId'] == null) {
//     echo "<script>window.location='404.php'</script>";
// } else {
//     $productId = $_GET['productId'];
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
//     $quantity = $_POST['quantity'];
//     $addToCart = $cart->add_to_cart($productId, $quantity);
// }
?>
<style>
    h3.payment {
        font-size: 20px;
        text-align: center;
        font-weight: bold;
        text-decoration: underline;
    }
    .wrapper_method{
        text-align: center;
        width: 550px;
        margin:0 auto;
        border:1px solid #666;
        padding:20px;
        background: cornsilk;
    }

    .wrapper_method h3{
        margin-bottom: 20px;
    }
    
    .wrapper_method a{
        padding:10px;
        background:red;
        color:#fff;
    }

    
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
                    <h3 class="payment">Choose your method payment</h3>
                    <a class="payment_href" href="offlinepayment.php">Offline Payment</a>
                    <a class="payment_href" href="onlinepayment.php">Online Payment</a>
                    <a style="background:grey" href="cart.php"> <=Previous </a>
                </div>
            </div>

        </div>
    </div>
</div>
<?php require 'inc/footer.php' ?>