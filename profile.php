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
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Profile Customer</h3>
                </div>
                <div class="clear"></div>
            </div>
            <table class="tblone">
                <?php
                $id = Session::get('customer_id');
                $get_customers = $customer->show_customers($id);
                if ($get_customers) {
                    while ($result = $get_customers->fetch_assoc()) {
                ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $result['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo $result['address'] ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><?php echo $result['city'] ?></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td><?php echo $result['country'] ?></td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td><?php echo $result['zipcode'] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?php echo $result['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $result['email'] ?></td>
                        </tr>

                        </tr>
                        <tr>
                            <td colspan="3"><a href="editprofile.php">Update</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php require 'inc/footer.php' ?>