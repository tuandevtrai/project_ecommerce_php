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
}



?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa danh mục</h2>
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
                    <form action="?customerId=<?php $result['id']?>" method="post">
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
    </div>
</div>
<?php include 'inc/footer.php'; ?>