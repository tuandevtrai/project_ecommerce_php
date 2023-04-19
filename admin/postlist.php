<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php'; ?>
<?php
$post = new post();
if (isset($_GET['delId'])) {
	$id_cate_post = $_GET['delId'];
	$del_post = $post->del_post($id_cate_post);
}
if (isset($_GET['statusId_on'])) {
	$statusId = $_GET['statusId_on'];
	$update_status_on = $post->update_status_on($statusId);
}
if (isset($_GET['statusId_off'])) {
	$statusId = $_GET['statusId_off'];
	$update_status_off = $post->update_status_off($statusId);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<?php
			if (isset($del_post)) {
				echo $del_post;
			}
			if (isset($update_status_on)) {
				echo $update_status_on;
			}
			if (isset($update_status_off)) {
				echo $update_status_off;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Category Post Name</th>
						<th>Category Post Description</th>
						<td>Category Post Status</td>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$show_post = $post->show_post();
					if (isset($show_post)) {
						$i = 0;
						while ($result = $show_post->fetch_assoc()) {
							$i++
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['post_title'] ?></td>
								<td>
									<?php echo $result['description'] ?>
								</td>
								<td>
									<?php
									if ($result['status'] == 1) { ?>
										<a href="?statusId_on=<?php echo $result['id_cate_post'] ?>">On</a>
									<?php } else { ?>
										<a href="?statusId_off=<?php echo $result['id_cate_post'] ?>">Off</a>
									<?php	} ?>
								</td>
								<td>
									<a href="postedit.php?update_id_cate_post=<?php echo $result['id_cate_post'] ?>">Edit</a> ||
									<a href="?delId=<?php echo $result['id_cate_post'] ?>" onclick="return confirm('Are you sure to Delete!');">Delete</a>
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