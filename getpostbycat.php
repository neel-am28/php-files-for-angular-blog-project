<?php 
	include('config.php');
	header("Access-Control-Allow-Origin: *");
	$cat_id = $_GET['cat_id'];

	$fetch="SELECT * FROM `blog_post` WHERE cat_id = '$cat_id'";
	$run = mysqli_query($conn, $fetch);
	while($result=mysqli_fetch_assoc($run)){
		$data[] = array_map('utf8_encode', $result);
	}
	echo json_encode($data);
?>