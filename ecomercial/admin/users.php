<?php 
require_once '../core/int.php';
if (!is_logged_in()) {
	login_error_ridirect();
}
if (!has_permission('admin')) {
	permission_error_redirect('index.php');
}
include 'includes/head.php';
include 'includes/navegation.php';
if (isset($_GET['delete'])) {
	$delete_id = sanitize($_GET['delete']);
	$db->query("DELETE FROM users WHERE id = '$delete_id'");
	$_SESSION['success_flash'] = "The User was deleted successfully";
	header("Location:users.php");
}


	$sql = "SELECT * FROM users ORDER BY full_name";
	$uresults = $db->query($sql);
if (isset($_GET['add']) || isset($_GET['edit']) ) {
	$permitionsQuery=$db->query("SELECT * FROM users ORDER BY permissions");
$full_name = ((isset( $_POST['full_name']) && $_POST['full_name'] != '')?sanitize($_POST['full_name']):'');
$email=((isset( $_POST['email']) &&  !empty($_POST['email']))?sanitize($_POST['email']):'');
$password=((isset( $_POST['password']) &&  !empty($_POST['password']))?sanitize($_POST['password']):'');
$confirm=((isset( $_POST['confirm']) &&  !empty($_POST['confirm']))?sanitize($_POST['confirm']):'');
$last_login = ((isset( $_POST['last_login']) && $_POST['last_login'] != '')?sanitize($_POST['last_login']):'');
$permissions = ((isset( $_POST['permissions']) && $_POST['permissions'] != '')?sanitize($_POST['permissions']):'');
$errors= array();
if (isset($_GET['edit'])) {
   $edit_id = (int)$_GET['edit'];
   $usersresults = $db->query("SELECT * FROM users WHERE id = '$edit_id'");
   $usersquery = mysqli_fetch_assoc($usersresults);

   
   $full_name = ((isset( $_POST['full_name']) && $_POST['full_name'] != '')?sanitize($_POST['full_name']):$usersquery['full_name']);
   $email = ((isset( $_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$usersquery['email']);
   $password = ((isset( $_POST['password']) && $_POST['password'] != '')?sanitize($_POST['password']):$usersquery['password']);
  $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');

   $last_login = ((isset( $_POST['last_login']) && $_POST['last_login'] != '')?sanitize($_POST['last_login']):$usersquery['last_login']);
   $permissions = ((isset( $_POST['permissions']) && $_POST['permissions'] != '')?sanitize($_POST['permissions']):$usersquery['permissions']);
  


}
if ($_POST) {

 /* $emailQuery = $db->query("SELECT * FROM users WHERE email='$email'");
  $emailCount = mysqli_num_rows($emailQuery);
  if ($emailCount!=0) {
  	$errors[] = "the email alread exist in the system";
  	}*/
  	 

  $errors=array();
  $required=Array('full_name','email','password','last_login','permissions');
  foreach ($required as $fields) {
    if ($_POST[$fields] == '') {
      $errors[] = "All Fields with Astrisk are required.";
      break;}
  }
    if (strlen($password)<6) {
               $errors[] = "password must to be at lest 6";
            }
    if ($password != $confirm) {
              $errors[] = "The new password and confirm new password does not match!";
            }
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
               $errors[] = "You must enter the valid email";
            }

  if (!empty($errors)) {
   echo display_errors($errors);
  }else{

  	$hashed =  password_hash($password, PASSWORD_DEFAULT);
      $insertSql = "INSERT INTO users (`full_name`, `email`, `password`, `last_login`, `permissions`) VALUES ('$full_name', '$email', '$hashed', '$last_login', '$permissions')";
      $_SESSION['success_flash'] = "User add successfully";
   if (isset($_GET['edit'])){
         $insertSql = "UPDATE users SET `full_name`='$full_name', `email` ='$email', `password`='$hashed', `last_login`='$last_login', `permissions`='$permissions' WHERE id='$edit_id'";
         $_SESSION['success_flash'] = "User update successfully";
   }
     $db -> query($insertSql);
   header('Location: users.php');
  }
}

	?>
<div class="container-fluid">
<h2 class="text-center"><?=((isset( $_GET['edit']))?'Edit':'Add a  New');?> User</h2>
<form action="users.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1')?>" method="POST">
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="title">Full name*:</label>
      <input type="text" name="full_name" class="form-control" id="full_name" value="<?=$full_name?>" required>
    </div>
   
    
      <div class="form-group col-md-3">
      <label for="email">Email*:</label>
      <input type="text" name="email" class="form-control" id="email" value="<?=$email?>"required>
    </div>
    <div class="form-group col-md-3">
      <label for="password">Password*:</label>
      <input type="password" name="password" class="form-control" id="password" value="<?=$password?>" required>
    </div>
    <div class="form-group col-md-3">
      <label for="confirm">Confirm Password:</label>
      <input type="password" name="confirm" class="form-control" id="confirm" value="<?=$confirm?>"required>
    </div>

    
      <div class="form-group col-md-3">
      <label for="last_login">Last Login:</label>
      <input type="datetime" name="last_login" class="form-control" id="last_login" value="<?=$last_login?>"required>
    </div>
      <div class="form-group col-md-3">
      <label for="permissions">Permissions:</label>
     <select class="form-control" id="permissions" name="permissions">
     <option value=""<?=(($permissions== '' )?' selected':'');?>></option>
     <option value="editor"<?=(($permissions== 'editor' )?' selected':'');?>>Editor</option>
     <option value="admin,editor"<?=(($permissions== 'admin,editor' )?' selected':'');?>>Admin</option>
     
      </select>
    </div>
<div class="form-group col-md-3 mx-auto ">
  <a href="users.php" class="btn btn-outline-secondary"> Back</a>
<button type="submit" class="btn btn-outline-secondary"><?=((isset( $_GET['edit']))?'Edit ':'Add ');?> User</button>
</div>
</form>
</div>

<?php  }
else{?>

<div class="container-fluid">
<h2 class="text-center">Users</h2>
<a href="users.php?add=1" class="btn btn-success float-right" id="add-product-btn">Add New User</a><div class="clearfix">
<div class="container-fluid">
<div class="clearfix"></div>
<hr>

<table class="table table-sm  table-striped">
 <thead class="thead-dark">
  	<th>Full Name</th>
  	<th>Email</th>
  	<th>Join Date</th>
  	<th>Last login</th>
	<th>Permissions</th>
  	<th>Actions</th>
  </thead>
  <tbody>
 <?php while ($user= mysqli_fetch_assoc($uresults)):?>
 	<tr>
 		<td><?=$user['full_name'];?></td>
 		<td><?=$user['email'];?></td>
 		<td><?=formatdate($user['join_date']);?></td>
 		<td><?=(($user['last_login']== '2018-08-01 00:00:00' )?'Never':formatdate($user['last_login']));?></td>
 		<td><?=$user['permissions']?></td>
 		<td>

 			<a href="users.php?edit=<?=$user['id'];?>" class="btn btn-xs btn-default"><i class="fas fa-user-edit"></i></a>
 			<?php
if ($user['id']!= $user_data['id'] ):?>

<a href="users.php?delete=<?=$user['id'];?>" class="btn btn-xs btn-default"><i class="fas fa-trash"></i></a>
<?php endif;?>
 		 </td>
 	</tr>
 <?php endwhile;?>
  </tbody>
</table>
</div>
</div>

<?php }include 'includes/footer.php';?>