<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php'; ?>
<?php include '../classes/news.php'; ?>

<?php
$new = new news();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $insert_new = $new->insert_new($_POST, $_FILES);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm tin tức mới</h2>
        <div class="block">
            <?php
            if (isset($insert_new)) {
                echo $insert_new;
            }
            ?>
            <form action="newadd.php" method="post" enctype="multipart/form-data">

                <table class="form">
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter title Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Description</label>
                        </td>
                        <td>
                            <input type="text" name="description" placeholder="enter description" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea name="content" placeholder="enter content"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category Post Name</label>
                        </td>
                        <td>
                            <select name="category_post_name">
                                <option>---CHOOSE CATEGORY POST NAME---</option>
                                <?php
                                $post = new post();
                                $show_post_name = $post->show_post_name();
                                if ($show_post_name) {
                                    while ($result = $show_post_name->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $result['id_cate_post'] ?>"> <?php echo $result['post_title'] ?> </option>
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
                            <input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Status</label>
                        </td>
                        <td>
                            <select id="select" name="status">
                                <option>---Select Status---</option>
                                <option value="1">On</option>
                                <option value="0">Off</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
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