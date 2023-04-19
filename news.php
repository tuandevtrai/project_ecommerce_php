<?php require_once 'inc/header.php';
require_once 'inc/slider.php';
?>
<div class="main">
	<?php
		//echo session_id();
	?>
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Tin game</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
            $new =new news();
			$get_tin_game = $new->get_tin_game();
			if ($get_tin_game) {
				while ($result = $get_tin_game->fetch_assoc()) 
				{
			?>
					<div class="grid_1_of_4 images_1_of_4" >
						<a href="details.php"><img src="./admin/uploads/<?php echo $result['image'] ?>" height="100px"/></a>
                        <p><span><?php echo $fm->textShorten( $result['description'],70) ?></span></p>
                        <p><span><?php echo $fm->textShorten( $result['content'],120) ?></span></p>
						<div class="button"><span><a href="detailnews.php?newId=<?= $result['id'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_top">
			<div class="heading">
				<h3>Tin khoa học</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
            $new =new news();
			$get_tin_khoa_hoc = $new->get_tin_khoa_hoc();
			if ($get_tin_khoa_hoc) {
				while ($result_khoa_hoc = $get_tin_khoa_hoc->fetch_assoc()) 
				{
			?>
					<div class="grid_1_of_4 images_1_of_4" >
						<a href="details.php"><img src="./admin/uploads/<?php echo $result_khoa_hoc['image'] ?>" height="100px"/></a>
                        <p><span><?php echo $fm->textShorten( $result_khoa_hoc['description'],70) ?></span></p>
                        <p><span><?php echo $fm->textShorten( $result_khoa_hoc['content'],120) ?></span></p>
						<div class="button"><span><a href="detailnews.php?newId=<?= $result_khoa_hoc['id'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
        <div class="content_top">
			<div class="heading">
				<h3>Tin thể thao</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
            $new =new news();
			$get_tin_the_thao = $new->get_tin_the_thao();
			if ($get_tin_the_thao) {
				while ($result_the_thao = $get_tin_the_thao->fetch_assoc()) 
				{
			?>
					<div class="grid_1_of_4 images_1_of_4" >
						<a href="details.php"><img src="./admin/uploads/<?php echo $result_the_thao['image'] ?>" height="100px"/></a>
                        <p><span><?php echo $fm->textShorten( $result_the_thao['description'],70) ?></span></p>
                        <p><span><?php echo $fm->textShorten( $result_the_thao['content'],120) ?></span></p>
						<div class="button"><span><a href="detailnews.php?newId=<?= $result_the_thao['id'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		
		<div class="">
			<?php
				 $new_all=$new->get_all_new();
				 $new_count=mysqli_num_rows($new_all);
				 $new_button=ceil($new_count/4);
				 for($i=1;$i<=$new_button;$i++){
					echo '<a style="margin:0 5px" href="news.php?Trang='.$i.'">Trang '.$i.'</a>';
				 }
			?>
		</div>
	</div>
</div>
<?php require 'inc/footer.php' ?>