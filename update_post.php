<?php 
	require_once("config.php");
	/*if (isset($_POST['category'])) {
		print_r("Category"." ". $_POST['category']);
        // $category = $_POST['category'];
    }
    else {
    	print_r($_POST['cat_id']);
        // $category = $_POST['cat_id'];
    } 
	die;*/
	$post_id=$_POST['post_id'];
	$content=$_POST['content'];
	if (isset($_POST['category'])) {
        $category = $_POST['category'];
    }
    /*else {
        $category = $_POST['cat_id'];
    } */
	$post_head = $_POST['post_head'];
	date_default_timezone_set('Asia/Kolkata');
	$date = date('M,d,Y h:i:s A');

	$old_file=$_POST['old_image'];
	$file=$_FILES['image']['name'];

	// if($post_id!="" && $content!="" && $category!="" && $post_head!=""){
		$update="UPDATE `blog_post` SET `post_heading`='".$post_head."', `content`='".$content."', `cat_id`='".$category."', `added_on`='".$date."' where `post_id`=$post_id";
		mysqli_query($conn, $update);
	// }

	if($file!=""){
		unlink("uploads/".$old_file);
		$file_name=Date('Ymdhis');
		$ext_array=explode('.',$file);
		$ext=$ext_array[count($ext_array)-1];
		$new_file_name=$file_name.'.'.$ext;
		$source=$_FILES['image']['tmp_name'];
		$destination="uploads/".$new_file_name;
		move_uploaded_file($source, $destination);
		$update="UPDATE `blog_post` SET `featured_image`='".$new_file_name."' WHERE `post_id`=$post_id";
		mysqli_query($conn, $update);
		header("Location:view_post.php?msg=success-update");
	}
	else{
		$update="UPDATE `blog_post` SET `featured_image`='".$old_file."' WHERE `post_id`=$post_id";
		mysqli_query($conn, $update);
		header("Location:view_post.php?msg=success-update");
	}

	
?>