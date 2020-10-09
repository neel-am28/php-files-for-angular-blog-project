<?php
  include('config.php');
  header("Access-Control-Allow-Origin: *");
  $cat_id = $_GET['cat_id'];
  $post_id = $_GET['post_id'];
  $fetch = "SELECT * from `blog_post` where `cat_id` = $cat_id AND `post_id` NOT LIKE '$post_id'";
  $run = mysqli_query($conn, $fetch);
  while($result=mysqli_fetch_assoc($run)){
    $data[] = array_map('utf8_encode', $result);
  }
  echo json_encode($data);                       
?>