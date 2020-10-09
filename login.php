<?php 
include("sweetalert.php");
if(isset($_GET['msg']) && $_GET['msg']=="please-login" && $_GET['msg']!=""){
  echo "<script>swal('Please login to access this file');</script>";
}
if(isset($_POST['submit'])){
  include("config.php");
  $email = $_POST['email'];
  $password = $_POST['password'];
  $select = "SELECT * FROM `blog_admin` WHERE `email`='$email' && `password`='$password'";
  $query = mysqli_query($conn, $select);
  $result = mysqli_fetch_assoc($query);
  if (mysqli_num_rows($query) == 1){
    session_start();
    $_SESSION['email'] = $result['email'];
    header("Location:dashboard.php?msg=success-login");
  }
}
else {

?>
<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="login.php" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
        </form>
      </div>
    </div>
  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

</body>

</html>
<?php }

?>