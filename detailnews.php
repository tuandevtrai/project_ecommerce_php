<?php require 'inc/header.php';
//require 'inc/slider.php';
?>
<?php
if (!isset($_GET['newId']) || $_GET['newId'] == null) {
    echo "<script>window.location='404.php'</script>";
} else {
    $newId = $_GET['newId'];
}
?>
<div class="main">
    <div class="content">
        <?php
        $new = new news();
        $get_new_details = $new->get_new_details($newId);
        if ($get_new_details) {
            while ($result_new_details = $get_new_details->fetch_assoc()) {
        ?>
                <div class="content_top">
                    <div class="heading">
                        <h3><?php echo $result_new_details['title'] ?></h3>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="section group">
                    <div class="col-md-12">
                    <h3><?= $result_new_details['description'] ?></h3>
                        <img src="./admin/uploads/<?php echo $result_new_details['image'] ?>" />
                        <p><?= $result_new_details['content'] ?></p>
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
</div>
</div>
<?php require 'inc/footer.php' ?>