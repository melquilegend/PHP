<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecomercial/core/int.php';
if (!is_logged_in()) {
  login_error_ridirect();
}
$hashed = $user_data['password'];
$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password=trim($old_password);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password=trim($password);
$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm=trim($confirm);
$new_hashed =  password_hash($password, PASSWORD_DEFAULT);
$user_id = $user_data['id'];
$errors= array();
include 'includes/head.php';
include 'includes/navegation.php';

  if($_POST){
            if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])){

              $errors[] = "You must to fill out all fields";
            }
            
        
            if (strlen($password)<6) {
               $errors[] = "password must to be at lest 6";
            }
                if ($password != $confirm) {
              $errors[] = "The new password and confirm new password does not match!";
            }
        
            if (!password_verify($old_password, $hashed)) {
              $errors[] = "Your old password is not correct";
            }
       

            if (!empty($errors)) {
             echo display_errors($errors);
            }else{
            
                $db->query("UPDATE users SET password = '$new_hashed' WHERE id ='$user_id'");
                $_SESSION['success_flash'] = "Your password was Change successfully";
                header("Location:index.php");
              }



        }
?>
 
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  
 <form action="" method="post">
  <div class="form-group">
     <label for="inputPassword" class="sr-only">Old Password</label>
      <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Old Password" value="<?=$old_password;?>"required>
  </div>
      <div class="form-group">
     <label for="inputPassword" class="sr-only">New Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="<?=$password;?>"required>
  </div>
      <div class="form-group">
     <label for="inputPassword" class="sr-only">Confirm Password</label>
      <input type="password" id="confirm" name="confirm" class="form-control" placeholder="Confirm Password" value="<?=$confirm;?>"required>
  </div>
 

  
      <div class="modal-footer">
        <a href="index.php" class="btn btn-secondary">Cancel</a>
        <button type="submit"  class="btn btn-primary">Submit</button>
      </div>
</form>
</div>
</main>