<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecomercial/core/int.php';
$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email=trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password=trim($password);


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <div class="container">
  <div class="row">
    <div class="col-sm-8">
      <img class="login" src="img/cart.jpg" width="600" height="400">
    </div>
    <div class="col-sm-4">
    <form class="form-signin" action="login.php" method="post">
      <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <div>
        <?php
        if($_POST){
            if (empty($_POST['email']) || empty($_POST['password'])){

              $errors[] = "You must provide email and password";
            }
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
               $errors[] = "You must enter the valid email";
            }
            if (strlen($password)<6) {
               $errors[] = "password must to be at lest 6";
            }
            $query=$db->query("SELECT * FROM users WHERE email = '$email'");
            $user=mysqli_fetch_assoc($query);
            $userCount = mysqli_num_rows($query); echo $userCount;
            if ($userCount<1) {
              $errors[] = "That email doesn\'t exist in the System";
            }
            if (!password_verify($password, $user['password'])) {
              $errors[] = "the password is wrong try agan";
            }
       

            if (!empty($errors)) {
             echo display_errors($errors);
            }else{
              $user_id=$user['id'];
              login($user_id);

            }



        }

        ?>

      </div>
      <?php $errors = array(); ?>
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="email" class="form-control" name="email" value="<?=$email;?>" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="<?=$password;?>"required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <p><a href="/ecomercial/index.php">Visit Site</a></p>
      <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
    </form>
  </div>
  </body>
</html>
