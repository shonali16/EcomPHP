<?php
include('server/connection.php');
session_start();
if(isset($_POST['login_btn'])){
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT user_id, user_name, user_email , user_password FROM users WHERE user_email = ? AND user_password=?");
  $stmt->bind_param('ss', $email, $password);
  if($stmt->execute()){
    $stmt->bind_result($user_id , $user_name, $user_email, $user_password);
    $stmt->store_result();
    if($stmt->num_rows() == 1){
      $stmt->fetch();

      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['user_email'] = $user_email;
      $_SESSION['logged_in'] = true;
      header('location:account.php?message=logged in successfully');
    }
    else{
      header('location: login.php?error=could not verify check your email or password');
    }
  }

}
?>
<?php
include('layouts/header.php');
include('layouts/navbar.php');

?>

<div class="container form-container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center">Login</h2>
      <?php if(isset($error)): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $error; ?>
        </div>
      <?php endif; ?>
      <form action="login.php" method="POST" >
        <p style="color:Red"><?php if(isset($_GET['error'])){
          echo $_GET['error'];
          }?></p>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <input type="submit" class="btn btn-primary btn-block mt-3" name="login_btn" value="Login">
      </form>
    </div>
  </div>
</div>