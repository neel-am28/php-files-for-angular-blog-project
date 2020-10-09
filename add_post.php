<?php
session_start();
if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
include("common.php");
include('config.php');
?>
<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Posts</a>
      </li>
      <li class="breadcrumb-item active">Add Post</li>
    </ol>

    <!-- Icon Cards-->
    <div class="card w-80 mx-auto p-4 shadow">
      <form role="form" action="insert_post.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Select Category:</label>
            <select class="form-control" name="category">
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
            <input type="text" class="form-control" placeholder="Enter heading" name="post_head" required>
          </div>

          <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control" placeholder="Enter author">
          </div>

          <div class="form-group">
            <label>Featured Image</label>
            <input type="file" name="image" class="form-control-file">
          </div>
	
          <div class="form-group">
              <label>Post Content: </label>
              <textarea name="content" required></textarea>
              <script>
                CKEDITOR.replace('content', {
                filebrowserUploadUrl: 'upload.php',
                filebrowserUploadMethod: 'form'
              });
              </script>
          </div>
                          
          <button type="submit" class="btn btn-primary btn-sm">
              <i class="fa fa-dot-circle-o"></i> Add Post
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