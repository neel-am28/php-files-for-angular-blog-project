<?php 
	require_once('config.php');
	header("Access-Control-Allow-Origin: *");
	$cat_id = $_GET['cat_id'];
	$fetch="SELECT `blog_category`.*, `blog_post`.* FROM `blog_category` JOIN `blog_post` ON `blog_category`.cat_id = `blog_post`.cat_id WHERE `blog_post`.cat_id = '$cat_id' LIMIT 1";
	$run = mysqli_query($conn, $fetch);
	while($result=mysqli_fetch_assoc($run)){
		$data[] = $result;
	}
	echo json_encode($data);
?>