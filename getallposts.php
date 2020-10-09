<?php 
	require_once('config.php');
	header("Access-Control-Allow-Origin: *");
	$fetch="SELECT * FROM `blog_post` ORDER BY `post_id` DESC";
	$run = mysqli_query($conn, $fetch);
	while($result=mysqli_fetch_assoc($run)){
	    $data[] = array_map('utf8_encode', $result);
	}
	// 	echo json_last_error_msg(); // Print out the error if any
	// die(); // halt the script
	echo json_encode($data);
?>