<?php 
session_start();
if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
include("common.php");
if(isset($_GET['msg']) && $_GET['msg']=="success-delete" && $_GET['msg']!=""){
	echo "<script>swal('Phew!!','Post Deleted Successfully','success');</script>";
}
if(isset($_GET['msg']) && $_GET['msg']=="success-insert" && $_GET['msg']!=""){
  	echo "<script>swal('Yaass!','Post Added Successfully','success');</script>";
}
if(isset($_GET['msg']) && $_GET['msg']=="success-update" && $_GET['msg']!=""){
    echo "<script>swal('Awesome!!','Post Updated Successfully','success');</script>";
}
?>
<link rel="stylesheet" href="vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Categories</a>
      </li>
      <li class="breadcrumb-item active">View Post</li>
    </ol>	
	<a href="add_post.php" class="btn btn-info mb-3">Add Post</a>
    <table id="bootstrap-data-table-export" class="table table-hover table-striped table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Post Category</th>
          <th>Post Heading</th>
          <th>Date Added On</th>   
          <th>Actions</th>
      </thead>
      <tbody>
        <?php
          include('config.php');
          $fetch = "SELECT `blog_post`.*, `blog_category`.cat_name FROM `blog_post` JOIN `blog_category` ON blog_category.cat_id=blog_post.cat_id order by `post_id` desc";
          $run = mysqli_query($conn, $fetch);
          $srno = 1;
          while ($res = mysqli_fetch_assoc($run)) { ?>
            <tr>
              <td> <?php echo $srno++; ?></td>
              <td> <?php echo $res['cat_name']; ?> </td>
              <td> <?php echo $res['post_heading']; ?> </td>
              
              <td> <?php echo $res['added_on']; ?> </td>
              <td class="w-25">
                <a data-toggle="modal" data-target="#edit_post_modal" class="edit_post btn btn-info text-white" post_id="<?php echo $res['post_id']; ?>">Edit</a>
                <a class="btn btn-danger text-white delete_post" post_id="<?php echo $res['post_id'];?>">Delete</a>
              </td>
            </tr>
        <?php } ?>
      </tbody>
    </table>
   </div>
<!-- /.container-fluid -->
</div>
<!-- content-wrapper-end -->
</div> 
<!-- wrapper end(from common.php) -->


<div class="modal fade" id="edit_post_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php 
	$select="SELECT * FROM blog_post where post_id ='1' ";
	$query=mysqli_query($conn, $select);
	$result=mysqli_fetch_assoc($query);
	?>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Post Content</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="update_post.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
        	<div class="form-group">
            <label>Select Category:</label>
            <select class="form-control" name="category" id="category">

              <option selected disabled hidden></option>
              <?php
                $select = "SELECT * FROM `blog_category`";
                $query = mysqli_query($conn, $select);
                while ($category = mysqli_fetch_assoc($query)) {?>
                  
                <option value="<?php echo $category['cat_id']; ?>" required> <?php echo $category['cat_name']; ?></option>
                <?php }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Post Heading</label>
            <input type="text" class="form-control" name="post_head" required>
          </div>
          <div class="form-group old_image">
             <!-- Old Image   -->
          </div>
          <div class="form-group">
            <label>Featured Image</label>
            <input type="file" name="image" class="form-control-file">
          </div>
          <input type="hidden" name="cat_id">
          <input type="hidden" name="old_image">
          <input type="hidden" name="post_id">
          <div class="form-group">
              <label>Post Content: </label>
              <textarea name="content"></textarea>
              <script>
                CKEDITOR.replace('content', {
                filebrowserUploadUrl: 'upload.php',
                filebrowserUploadMethod: 'form'
              });
              </script>
          </div>
          

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    // $('#bootstrap-data-table-export').DataTable();
    $('.edit_post').click(function() {
      $('#bootstrap-data-table-export').DataTable();
      var post_id = $(this).attr('post_id');
      $.ajax({
        'url': 'get_single_post.php',
        'data': 'post_id=' + post_id,
        'method': 'get',
        'datatype': 'json',
        success: function(result) {
          var res = JSON.parse(result);
          var content = res.content;
          CKEDITOR.instances['content'].setData(content);
          $('input[name="post_id"]').val(res.post_id);
          $('input[name="old_image"]').val(res.featured_image);
          // $('input[name="cat_id"]').val(res.cat_id);
          $('input[name="post_head"]').val(res.post_heading);
          $('#category').val(res.cat_id).prop('selected', true);
          var image = res.featured_image;
          var src='uploads/'+image;
          var image_div="<img src='"+src+"' style='width:450px; height:250px;'>";
          $('.old_image').html(image_div); 
        }
      });
    });
  });

  $('.delete_post').click(function() {
      var post_id = $(this).attr('post_id');
    	swal({
    		title: "Are you sure you want to remove this post?",
    		text: "",
    		icon: "warning",
    		buttons: ["No", "Yes"],
    		dangerMode: true,
    	})
    	.then((willDelete) => {
    		if(willDelete){
    			window.location.assign("delete_post.php?post_id="+post_id);
    		}
    		else{

    		}
    	});
    });

</script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<?php }
    else {
        header("Location:login.php");
    }