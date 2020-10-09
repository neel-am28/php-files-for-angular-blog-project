<?php
	require_once('config.php');
	$post_id=$_GET['post_id'];
	$delete="DELETE FROM `blog_post` where `post_id`=$post_id";
	$result = mysqli_query($conn, $delete);
	header("Location:view_post.php?msg=success-delete");
 ?>