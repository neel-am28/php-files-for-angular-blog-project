<?php
	require_once('config.php');
	$cat_id=$_GET['cat_id'];
	$delete="DELETE FROM `blog_category` where `cat_id`=$cat_id";
	$result = mysqli_query($conn, $delete);
	header("Location:view_category.php?msg=success-delete");
 ?>