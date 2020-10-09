<?php 
	include('config.php');
	$cat_name=$_POST['cat_name'];
	$insert="INSERT INTO `blog_category` ( `cat_name`) VALUES ('$cat_name')";
	mysqli_query($conn, $insert);
	header("Location:view_category.php?msg=success-insert");
?>