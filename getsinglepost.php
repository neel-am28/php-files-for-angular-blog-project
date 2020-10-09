<?php 
    require_once('config.php');
    header("Access-Control-Allow-Origin: *");
	$post_id=$_GET['post_id'];
	$select="SELECT * FROM `blog_post` where post_id = $post_id";
	$query=mysqli_query($conn, $select);
	$result=mysqli_fetch_assoc($query);
	echo json_encode(array_map('utf8_encode', $result));
?>

