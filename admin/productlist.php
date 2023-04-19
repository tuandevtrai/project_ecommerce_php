<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>
<?php require_once '../helpers/format.php'; ?>
<?php
$product = new product();
$fm = new Format();
if (isset($_GET['delId'])) {
    $id = $_GET['delId'];
    $delProduct = $product->delete_product($id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">
            <?php
            if (isset($delProduct)) {
                echo $delProduct;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Image</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $productlist = $product->show_product();
                    if ($productlist) {
                        $i = 0;
                        while ($result = $productlist->fetch_assoc()) {
                            $i++;
                    ?>
                    <tr class="odd gradeX ">
                        <td><?= $i ?></td>
                        <td><?= $result['productName'] ?></td>
                        <td><?= $fm->format_currency($result['price'])." đ" ?></td>
                        <td><img src="uploads/<?php echo $result['image'] ?>" height="100px" /></td>
                        <td><?= $result['catName'] ?></td>
                        <td><?= $result['brandName'] ?></td>
                        <td><?= $fm->textShorten($result['productDesc'], 50)  ?></td>
                        <td><?php
                                    if ($result['type'] == 0) {
                                        echo 'Non-Feature';
                                    } else {
                                        echo 'Feature';
                                    }
                                    ?></td>
                        <td><a href="productedit.php?productId=<?= $result['productId'] ?>">Edit</a> || <a
                                href="productlist.php?delId=<?= $result['productId'] ?>">Delete</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    setupLeftMenu();
    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>
<?php include 'inc/footer.php'; ?>