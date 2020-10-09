<?php 
	include('config.php');
	$category = $_POST['category'];
	$content=$_POST['content'];
	$post_head = $_POST['post_head'];
	$author = $_POST['author'];

	date_default_timezone_set('Asia/Kolkata');
	$date = date('M,d,Y h:i:s A');

	$file = $_FILES['image']['name'];
	if($file != ""){
		$file_name=Date('Ymdhis');
		$ext_array=explode('.',$file);
		$ext=$ext_array[count($ext_array)-1];
		$new_file_name=$file_name.'.'.$ext;
		$source=$_FILES['image']['tmp_name'];
		$destination="uploads/".$new_file_name;
		move_uploaded_file($source, $destination);
		
		echo $insert="INSERT INTO `blog_post` ( `featured_image`,`post_heading`,`content`, `cat_id`, `added_on`, `author`)VALUES ('".$new_file_name."', '".$post_head."','".$content."', '".$category."', '".$date."', '".$author."')";
		// die;
		mysqli_query($conn, $insert);
		header("Location:view_post.php?msg=success-insert");
	}
	
?>