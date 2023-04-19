<?php require 'inc/header.php';
//require 'inc/slider.php';
?>
<?php

?>

<style type="text/css">
    p.success_note{
        text-align: center;
        padding: 8px;
        font-size:17px;
    }
</style>
<form action="" method="post">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 style="color:red;text-align:center">Success Order</h2>
                <?php
                 $customer_id=Session::get('customer_id');
                $get_amount=$cart->get_amount_price($customer_id);
                if($get_amount){
                    $amount=0;
                    while($result=$get_amount->fetch_assoc()){
                       $price=$result['price'] ;
                       $amount+=$price;
                    }
                }
                ?>
                <p class="success_note">Total price you have bought form my website: <?php $vat=$amount*0.1;
                                                                                        echo $fm->format_currency($total=$amount+$vat)." VND"; ?></p>
                <p class="success_note">We will contact as soon as possible, Please see your order detail here <a href="orderdetails.php">Click here</a></p>
                <?php
                 
                ?>
            </div>
        </div>

    </div>
</form>
<?php require 'inc/footer.php' ?>