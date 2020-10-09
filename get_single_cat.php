<?php 
    require_once('config.php');
	$cat_id=$_GET['cat_id'];
	$select="SELECT * FROM blog_category where cat_id ='".$cat_id."' ";
	$query=mysqli_query($conn, $select);
	$result=mysqli_fetch_assoc($query);
	echo json_encode($result);
?>