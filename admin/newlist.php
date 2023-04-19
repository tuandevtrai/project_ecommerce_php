<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../helpers/format.php'; ?>
<?php include '../classes/news.php'; ?>
<?php include '../classes/post.php'; ?>
<?php
$new = new news();
$fm=new Format();
if (isset($_GET['delId'])) {
	$id = $_GET['delId'];
	$del_new = $new->del_new($id);
}
if (isset($_GET['status_on'])) {
	$status_id = $_GET['status_on'];
	$update_status_on = $new->update_status_on($status_id);
}
if (isset($_GET['status_off'])) {
	$status_id = $_GET['status_off'];
	$update_status_off = $new->update_status_off($status_id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
            <?php
            if (isset($del_new)) {
            	echo $del_new;
            }
            
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="10%">Title</th>
                        <th width="20%">Description</th>
                        <th width="30%">Content</td>
                        <th width="10%">Category Post Name</th>
                        <th width="10%">Image</th>
                        <th width="5%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $show_new = $new->show_post_name();
                    if (isset($show_new)) {
                        $i = 0;
                        while ($result = $show_new->fetch_assoc()) {
                            $i++
                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['title'] ?></td>
                                <td>
                                    <?php echo $result['description'] ?>
                                </td>
                                <td>
                                 <?= $fm->textShorten($result['content'], 200) ?>
                                </td>
                                <td>
                                    <?php echo $result['post_title'] ?>
                                </td>
                                <td>
                                    <img src="uploads/<?php echo $result['image'] ?>" width="200px" height="100px" />
                                </td>
                                <td>
                                    <?php
                                    if ($result['status'] == '1') {
                                    ?>
                                        <a href="?status_on=<?php echo $result['id'] ?>">On</a>
                                    <?php
                                    } else if ($result['status'] == '0') {
                                        ?>
                                        <a href="?status_off=<?php echo $result['id'] ?>">Off</a>
                                   <?php }
                                    ?>
                                </td>
                                <td>
                                    <a href="newedit.php?newId=<?php echo $result['id'] ?>">Edit</a>||
                                    <a href="?delId=<?php echo $result['id'] ?>">Delete</a>
                                </td>
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