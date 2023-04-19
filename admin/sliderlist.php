<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/slider.php'; ?>
<?php
$slider = new slider();
if (isset($_GET['delId'])) {
	$sliderId = $_GET['delId'];
	$del_slider = $slider->del_slider($sliderId);
}
if(isset($_GET['sliderId_on'])){
	$sliderId = $_GET['sliderId_on'];
	$update_slider_on = $slider->update_slider_on($sliderId);
}
if(isset($_GET['sliderId_off'])){
	$sliderId = $_GET['sliderId_off'];
	$update_slider_off = $slider->update_slider_off($sliderId);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Slider List</h2>
		<div class="block">
			<?php
				if(isset($del_slider)){
					echo $del_slider;
				}
				if(isset($update_slider_on)){
					echo $update_slider_on;
				}
				if(isset($update_slider_off)){
					echo $update_slider_off;
				}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Slider Title</th>
						<th>Slider Image</th>
						<td>Type</td>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$get_all_slider = $slider->show_all_slider();
					if (isset($get_all_slider)) {
						$i = 0;
						while ($result = $get_all_slider->fetch_assoc()) {
							$i++
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['sliderName'] ?></td>
								<td>
									<img src="uploads/<?php echo $result['image'] ?>" height="120px" width="500px" />
								</td>
								<td>
									<?php
									if ($result['type'] == 1) {?>
										<a href="?sliderId_on=<?php echo $result['sliderId'] ?>">On</a>
									<?php }else{ ?>
										<a href="?sliderId_off=<?php echo $result['sliderId'] ?>">Off</a>	
									<?php	} ?>
								</td>
								<td>
									<a href="?delId=<?php echo $result['sliderId'] ?>" onclick="return confirm('Are you sure to Delete!');">Delete</a>
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