<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php'; ?>
<?php
$post = new post();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_cate_name = $_POST['post_cate_name'];
    $post_cate_desc = $_POST['post_cate_desc'];
    $post_cate_status = $_POST['post_cate_status'];
    $insert_post_category = $post->insert_post_category($post_cate_name,$post_cate_desc,$post_cate_status);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm tin tức</h2>
        <div class="block copyblock">
            <?php if (isset($insert_post_category)) {
                echo $insert_post_category;
            } ?>
            <form autocomplete="off" action="postadd.php" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="post_cate_name" placeholder="Thêm danh mục ..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="post_cate_desc" placeholder="Thêm mô tả tin tức.." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="post_cate_status">
                                <option value="1"> Hiển thị</option>
                                <option value="0"> Ẩn</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>