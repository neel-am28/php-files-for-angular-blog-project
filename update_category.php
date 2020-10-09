<?php 
	require_once("config.php");
	$category_id=$_POST['category_id'];
	$category=$_POST['category'];
	$update="UPDATE `blog_category` set `cat_name`='".$category."' where `cat_id`=$category_id";
	mysqli_query($conn, $update);
	header("Location:view_category.php");
?>