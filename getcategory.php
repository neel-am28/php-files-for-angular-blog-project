<?php 
	include('config.php');
	header("Access-Control-Allow-Origin: *");
	$fetch="SELECT * FROM `blog_category`";
	$run = mysqli_query($conn, $fetch);
	while($result=mysqli_fetch_assoc($run)){
		$data[] = $result;
	}
	echo json_encode($data);
?>