<?php 
session_start();
if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
include("common.php");
if(isset($_GET['msg']) && $_GET['msg']=="success-delete" && $_GET['msg']!=""){
	echo "<script>swal('Success','Category Deleted Successfully','success');</script>";
}
if(isset($_GET['msg']) && $_GET['msg']=="success-insert" && $_GET['msg']!=""){
  echo "<script>swal('Success','Category Added Successfully','success');</script>";
}
?>
<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Categories</a>
      </li>
      <li class="breadcrumb-item active">View Category</li>
    </ol>	
	<a href="add_category.php" class="btn btn-info mb-3">Add Category</a>
    <table id="bootstrap-data-table-export cat_table" class="table table-hover table-striped table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Category Name</th>
          <th>Actions</th>
      </thead>
      <tbody>
        <?php
                  include('config.php');
                  $fetch = "SELECT * FROM `blog_category`";
                  $run = mysqli_query($conn, $fetch);
                  $srno = 1;
                  while ($res = mysqli_fetch_assoc($run)) { ?>
                    <tr>
                      <td> <?php echo $srno++; ?></td>
                      <td> <?php echo $res['cat_name']; ?> </td>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#edit_cat_modal" class="edit_cat btn btn-info" cat_id="<?php echo $res['cat_id']; ?>">Edit</a>
                        <a class="btn btn-danger text-white delete_cat" cat_id="<?php echo $res['cat_id'];?>">Delete</a>
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
<script>
  $(document).ready(function () {
    $('.edit_cat').click(function() {
      var cat_id = $(this).attr('cat_id');
      $.ajax({
        'url': 'get_single_cat.php',
        'data': 'cat_id=' + cat_id,
        'method': 'get',
        'datatype': 'json',
        success: function(result) {
          var res = JSON.parse(result);
          $('input[name="category"]').val(res.cat_name);
          $('input[name="category_id"]').val(res.cat_id);
        }
      });
    });
  });

  $('.delete_cat').click(function() {
      var cat_id = $(this).attr('cat_id');
    	swal({
    		title: "Are you sure you want to remove this category?",
    		text: "",
    		icon: "warning",
    		buttons: ["No", "Yes"],
    		dangerMode: true,
    	})
    	.then((willDelete) => {
    		if(willDelete){
    			window.location.assign("delete_category.php?cat_id="+cat_id);
    		}
    		else{

    		}
    	});
    });

</script>

<div class="modal fade" id="edit_cat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="update_category.php" method="POST">
        <div class="modal-body">
          <div class="form-group my-5">
            <label>Category Name:</label>
            <input type="text" class="form-control" name="category" required>
            <input type="hidden" class="form-control" name="category_id">
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

<?php }
    else {
        header("Location:login.php");
    }
