<?php
session_start();
if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
include("common.php");
?>
<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Categories</a>
      </li>
      <li class="breadcrumb-item active">Add Category</li>
    </ol>

    <!-- Icon Cards-->
    <div class="card w-50 mx-auto p-4 shadow">
      <form role="form" action="insert_category.php" method="POST">
          <div class="form-group">
              <label>Category Name: </label>
              <input type="text" class="form-control" placeholder="Enter Category" name="cat_name" required>
          </div>
                          
          <button type="submit" class="btn btn-primary btn-sm">
              <i class="fa fa-dot-circle-o"></i> Add Category
          </button>
          <button type="reset" class="btn btn-danger btn-sm">
              <i class="fa fa-ban"></i> Reset
          </button>               
      </form> 
    </div>
  </div>
<!-- /.container-fluid -->
</div>
<!-- content-wrapper-end -->
</div> 
<!-- wrapper end(from common.php) -->
<?php }
    else {
        header("Location:login.php");
    }