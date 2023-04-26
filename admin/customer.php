<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/customer.php');
include_once($filepath . '/../helpers/format.php')
?>
<?php
$customer = new customer();
if (!isset($_GET['customerId']) || $_GET['customerId'] == null) {
    echo "<script>window.location='inbox.php'</script>";
} else {
    $id = $_GET['customerId'];
    $order_code = $_GET['order_code'];
}



?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Chi tiet don hang</h2>
        <div class="block copyblock">
            <?php
            if (isset($updateCat)) {
                echo $updateCat;
            }
            ?>
            <?php
            $get_customer = $customer->show_customers($id);
            if ($get_customer) {
                while ($result = $get_customer->fetch_assoc()) {
            ?>
                    <form action="?customerId=<?php $result['id'] ?>" method="post">
                        <h3>Thông tin người đặt hàng</h3>
                        <table class="form">
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="name" value="<?php echo $result['name'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="address" value="<?php echo $result['address'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="city" value="<?php echo $result['city'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="country" value="<?php echo $result['country'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Zipcode</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="zipcode" value="<?php echo $result['zipcode'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="phone" value="<?php echo $result['phone'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="email" value="<?php echo $result['email'] ?>" class="medium" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php
                }
            }

            ?>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Giá sản phẩm</th>
                    <th scope="col">Số lượng sản phẩm</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $get_order = $customer->show_order($order_code);
                if ($get_order) {
                    $subtotal=0;
                    $total=0;
                    while ($result_order = $get_order->fetch_assoc()) {
                        $subTotal=$result_order['quantity'] * $result_order['price'];
                        $total+=$subTotal;
                ?>
                <tr>
                    <th><?php echo $result_order['productName'] ?></th>
                    <th><img src="uploads/<?php echo $result_order['image'] ?>"  height="50px"/></th>
                    <td><?php echo number_format($result_order['price'],0,',','.') ?></td>
                    <td><?php echo $result_order['quantity'] ?></td>
                    <td><?php echo number_format($subTotal,0,',','.') ?></td>
                </tr>
                
               <?php
                    }
                }
               ?>
               <tr>
                <td colspan="5">Thành tiền:<?php echo number_format($total,0,',','.') ?> </td>
               </tr>
            </tbody>
        </table>
    </div>
</div>
<?php include 'inc/footer.php'; ?>