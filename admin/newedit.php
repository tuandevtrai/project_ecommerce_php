<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/new.php'; ?>
<?php include '../classes/post.php'; ?>

<?php
$new = new news();
if (!isset($_GET['newId']) || $_GET['newId'] == null) {
    echo "<script>window.location='newlist.php'</script>";
} else {
    $id = $_GET['newId'];
}

if (isset($_GET['status_on'])) {
    $status_id = $_GET['status_on'];
    $update_status_on = $new->update_status_on($status_id);
}
if (isset($_GET['status_off'])) {
    $status_id = $_GET['status_off'];
    $update_status_off = $new->update_status_off($status_id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $update_new = $new->update_new($_POST, $_FILES, $id);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Cập nhật tin tức</h2>
        <div class="block">
            <?php
            if (isset($update_new)) {
                echo $update_new;
            }
            ?>
            <?php
            $get_new_by_id = $new->get_new_by_id($id);
            if ($get_new_by_id) {
                while ($result_new = $get_new_by_id->fetch_assoc()) {
            ?>
                    <form action="newedit.php?newId=<?= $result_new['id'] ?>" method="post" enctype="multipart/form-data">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?= $result_new['title'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Description</label>
                                </td>
                                <td>
                                    <input type="text" name="description" value="<?php echo $result_new['description'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Content</label>
                                </td>
                                <td>
                                    <input type="text" name="content" value="<?php echo $result_new['content'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Category Post Name</label>
                                </td>
                                <td>
                                    <select name="category_post_name">
                                        <?php
                                        $post = new post();
                                        $show_post = $post->show_post();
                                        if ($show_post) {
                                            while ($result_post = $show_post->fetch_assoc()) {
                                        ?>
                                                <option <?php
                                                        if ($result_post['id_cate_post'] == $result_new['category_post_id']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $result_post['id_cate_post'] ?>"><?php echo $result_post['post_title'] ?>
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src="uploads/<?= $result_new['image'] ?>" height="90" /><br />
                                    <input type="file" name="image" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Edit" />
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>