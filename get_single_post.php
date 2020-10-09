<?php 
    require_once('config.php');
	$post_id=$_GET['post_id'];
	$select = "SELECT `blog_post`.*, `blog_category`.* from `blog_post` JOIN `blog_category` ON `blog_post`.`cat_id` = `blog_category`.`cat_id` AND `blog_post`.`post_id` = '$post_id' ";
	$query=mysqli_query($conn, $select);
	$result=mysqli_fetch_assoc($query);
	echo json_encode($result);
?>