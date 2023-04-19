<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/customer.php'; ?>
<?php
$customer = new customer();

if(isset($_GET['status_customer_on'])){
	$id = $_GET['status_customer_on'];
	$update_status_on = $customer->update_status_on($id);
}
if(isset($_GET['status_customer_off'])){
	$id = $_GET['status_customer_off'];
	$update_status_off = $customer->update_status_off($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Customer list</h2>
		<div class="block">
			<?php
				// if(isset($del_slider)){
				// 	echo $del_slider;
				// }
				// if(isset($update_slider_on)){
				// 	echo $update_slider_on;
				// }
				// if(isset($update_slider_off)){
				// 	echo $update_slider_off;
				// }
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Id customer</th>
						<th>Name customer</th>
						<td>Status</td>
					</tr>
				</thead>
				<tbody>
					<?php

					$get_all_customer = $customer->get_all_customer();
					if (isset($get_all_customer)) {
						$i = 0;
						while ($result = $get_all_customer->fetch_assoc()) {
							$i++
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['id'] ?></td>
								<td><?php echo $result['name'] ?></td>
								<td>
									<?php
									if ($result['status_customer'] == 1) {?>
										<a href="?status_customer_on=<?php echo $result['id'] ?>">On</a>
									<?php }else{ ?>
										<a href="?status_customer_off=<?php echo $result['id'] ?>">Off</a>	
									<?php	} ?>
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