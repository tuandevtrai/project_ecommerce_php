<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php'; ?>
<?php
$post = new post();
if (!isset($_GET['update_id_cate_post']) || $_GET['update_id_cate_post'] == null) {
    echo "<script>window.location='postlist.php'</script>";
} else {
    $id = $_GET['update_id_cate_post'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']) {
    $id = $_POST['id_cate_post'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $update_post = $post->update_post($id, $title, $description);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa tin tức</h2>
        <div class="block copyblock">
            <?php
            if (isset($update_post)) {
                echo $update_post;
            }
            ?>
            <?php
            $get_post_update = $post->get_post_update($id);
            if ($get_post_update) {
                while ($result = $get_post_update->fetch_assoc()) {
            ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>

                                    <input type="hidden" name="id_cate_post" value="<?php echo $result['id_cate_post'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Title</label><br/>
                                    <input type="text" name="title" value="<?php echo $result['post_title'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Description</label><br/>
                                    <input type="text" name="description" value="<?php echo $result['description'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
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
<?php include 'inc/footer.php'; ?>