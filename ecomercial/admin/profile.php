<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecomercial/core/int.php';
if (!is_logged_in()) {
  login_error_ridirect();
}
include 'includes/head.php';
include 'includes/navegation.php';
$errors= array();
$userquery=$db->query("SELECT * FROM users WHERE id ='$user_id'");


    if (isset($_POST['update'])) {
$user_id =$_SESSION['SBuser'];
$full_name= sanitize($_POST['full_name']);
$email= sanitize($_POST['email']);
$updateusers = "UPDATE users SET `full_name`='$full_name', `email` ='$email' WHERE id=' $user_id'";
    $db -> query($updateusers);
$_SESSION['success_flash'] = "Your Profile was update successfuly";
                header("Location:profile.php");  }

?>
 
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
 <form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Full Name</label>
    <input type="text" class="form-control" id="full_name"  value="<?=$user_data['full_name'];?>" name="full_name">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?=$user_data['email'];?>">
  </div>
 

  
      <div class="modal-footer">
        <a href="index.php" class="btn btn-secondary">Cancel</a>
        <button type="submit" name="update" class="btn btn-primary">Save</button>
      </div>
</form>
</div>
</main>
