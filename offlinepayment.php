<?php require 'inc/header.php';
//require 'inc/slider.php';
?>
<?php
if (isset($_GET['orderId']) && $_GET['orderId'] == 'order') {
    $customer_id=Session::get('customer_id');
    $insertOrder=$cart->insertOrder($customer_id);
    $delCart=$cart->del_all_data_cart();
    header('location:success.php');
} 
?>

<style type="text/css">
    .box_left {
        width: 48%;
        border: 1px solid #666;
        float: left;
        padding: 10px;
    }

    .box_right {
        width: 48%;
        border: 1px solid #666;
        float: right;
        padding: 10px;
    }
    .submit_order{
        padding:10px 70px;
        border:none;
        background: red;
        font-size: 19px;
        color:#fff;
        margin:10px;
        cursor: pointer;
    }
</style>
<form action="" method="post">
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="heading">
                <h3>Offline Payment</h3>
            </div>
            <div class="clear"></div>
            <div class="box_left">
                <div class="cartpage">
                    <?php
                    if (isset($update_quantity_cart)) {
                        echo $update_quantity_cart;
                    }
                    if (isset($del_in_cart)) {
                        echo $del_in_cart;
                    }
                    ?>
                    <table class="tblone">
                        <tr>
                            <th width=5%>ID</th>
                            <th width="15%">Product Name</th>
                            <th width="15%">Price</th>
                            <th width="25%">Quantity</th>
                            <th width="20%">Total Price</th>
                        </tr>
                        <?php
                        $get_product_cart = $cart->get_product_cart();
                        if ($get_product_cart) {
                            $i = 0;
                            $subTotal = 0;
                            $qty = 0;
                            while ($result = $get_product_cart->fetch_assoc()) {
                                $i++;
                        ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?= $result['productName'] ?></td>
                                    <td><?= $fm->format_currency($result['price']) . " đ" ?></td>
                                    <td>
                                        <?php echo $result['quantity'] ?>
                                    </td>
                                    <td><?php $total = $result['price'] * $result['quantity'];
                                        echo $fm->format_currency($total) . " đ" ?></td>
                                </tr>
                        <?php
                                $subTotal += $total;
                                $qty = $qty + $result['quantity'];
                            }
                        }
                        ?>
                    </table>
                    <?php

                    $check_cart = $cart->check_cart();
                    if ($check_cart) {
                    ?>
                        <table style="float:right;text-align:left;margin:5px;" width="40%">
                            <tr>
                                <th>Sub Total : </th>
                                <td><?php

                                    echo $fm->format_currency($subTotal) . " đ";
                                    Session::set('sum', $subTotal);
                                    Session::set('qty', $qty);
                                    ?></td>
                            </tr>
                            <tr>
                                <th>VAT : </th>
                                <td>10% (<?php echo $vat = $subTotal * 0.1 . " đ" ?>) </td>
                            </tr>
                            <tr>
                                <th>Grand Total :</th>
                                <td><?php
                                    $vat = $subTotal * 0.1;
                                    $gtotal = $subTotal + $vat;
                                    echo $fm->format_currency($gtotal) . " đ";
                                    ?> </td>
                            </tr>
                        </table>
                    <?php
                    } else {
                        echo 'Your cart is empty! Please shopping now';
                    }
                    ?>
                </div>
            </div>
            <div class="box_right">
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
    <center><a href="?orderId=order" class="submit_order">Order Now</a></center><br/>
</div>
</form>
<?php require 'inc/footer.php' ?>