<?php 
if (file_exists("uploads/" . $_FILES["upload"]["name"]))
{
 echo $_FILES["upload"]["name"] . " already exists. ";
}
else
{
 move_uploaded_file($_FILES["upload"]["tmp_name"],
 "uploads/" . $_FILES["upload"]["name"]);
 echo "Image stored in: " . "http://localhost:8081/Blog_Project/uploads/" . $_FILES["upload"]["name"];
}
 ?>