<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php';
$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email=trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password=trim($password);
?>
<?php 
if (isset($_GET['add'])) {
$pacient_nomecompleto = ((isset( $_POST['pacient_nomecompleto']) && $_POST['pacient_nomecompleto'] != '')?sanitize($_POST['pacient_nomecompleto']):'');
$email=((isset( $_POST['email']) &&  !empty($_POST['email']))?sanitize($_POST['email']):'');
$address=((isset( $_POST['address']) &&  !empty($_POST['address']))?sanitize($_POST['address']):'');
$position_clinic=((isset( $_POST['position_clinic']) &&  !empty($_POST['position_clinic']))?sanitize($_POST['position_clinic']):'');
$cellphone=((isset( $_POST['cellphone']) &&  !empty($_POST['cellphone']))?sanitize($_POST['cellphone']):'');
$about=((isset( $_POST['about']) &&  !empty($_POST['about']))?sanitize($_POST['about']):'');
$especialidade=((isset( $_POST['especialidade']) &&  !empty($_POST['especialidade']))?sanitize($_POST['especialidade']):'');
$password=((isset( $_POST['password']) &&  !empty($_POST['password']))?sanitize($_POST['password']):'');
$confirm=((isset( $_POST['confirm']) &&  !empty($_POST['confirm']))?sanitize($_POST['confirm']):'');
$last_login = ((isset( $_POST['last_login']) && $_POST['last_login'] != '')?sanitize($_POST['last_login']):'');
$permissions = ((isset( $_POST['permissions']) && $_POST['permissions'] != '')?sanitize($_POST['permissions']):'');
$errors= array();

if ($_POST) {

 /* $emailQuery = $db->query("SELECT * FROM users WHERE email='$email'");
  $emailCount = mysqli_num_rows($emailQuery);
  if ($emailCount!=0) {
    $errors[] = "the email alread exist in the system";
    }*/


  $errors=array();
  $required=Array('pacient_nomecompleto','email','password');
  foreach ($required as $fields) {
    if ($_POST[$fields] == '') {
      $errors[] = "Todos os campos com asterisco são obrigatórios.";
      break;}
  }
    if (strlen($password)<6) {
               $errors[] = "a senha deve ter pelo menos 6";
            }
    if ($password != $confirm) {
              $errors[] = "A nova senha e a confirmação da nova senha não coincidem!";
            }
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
               $errors[] = "Você deve inserir o e-mail válido";
            }
    $check=$db->query("SELECT * FROM patient WHERE email = '$email'");
    //$check_email=mysqli_fetch_assoc($check);
    $userCount = mysqli_num_rows($check);
      if ($userCount > 0) {
       $errors[] = "Esse email ja exite, faça o login";
            }
  if (!empty($errors)) {
   echo display_errors($errors);
  }else{

    $hashed =  password_hash($password, PASSWORD_DEFAULT);
      $insertSql = "INSERT INTO patient (`pacient_nomecompleto`, `email`, `address`, `cellphone`, `about`, `password`) VALUES ('$pacient_nomecompleto', '$email', '$address', '$cellphone', '$about', '$hashed')";
      $_SESSION['success_flash'] = "Utilizador adicionado com sucesso";
     $db -> query($insertSql);
echo "<script>alert('Salvo'); window.location = './login.php';</script>";
  }
}
 }
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login Paciente</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.php"><img src="" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Bem vindo! Faça o logim para aceder a conta de paciente.</h4>
                                    <form action="inscrever.php?add=1" method="POST">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Nome Completo</strong></label>
                                            <input type="text" name="pacient_nomecompleto" value="" class="form-control" required>
                                        </div>
                                        <div class="form-group" data-validate = "Valid email is required: ex@abc.xyz">
                                            <label class="mb-1 text-white"><strong>Email</strong></label>
                                            <input type="email" name="email" value="" class="form-control" required>
                                        </div>
                                        <div class="form-group" >
                                            <label class="mb-1 text-white"><strong>Numero Telefonico</strong></label>
                                            <input type="text" name="cellphone" value="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Endereço</strong></label>
                                            <input type="text" name="address" value="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Sobre mim</strong></label>
                                            <input type="text" name="about" value="" class="form-control" required>
                                        </div>
                                        <div class="form-group" data-validate = "Valid email is required: ex@abc.xyz">
                                            <label class="mb-1 text-white"><strong>Senha</strong></label>

                                            <input type="password" name="password" value="" class="form-control" required>
                                        </div>
                                        <div class="form-group" data-validate = "Valid email is required: ex@abc.xyz">
                                            <label class="mb-1 text-white"><strong>Confirmar Senha</strong></label>

                                            <input type="password" name="confirm" value="" class="form-control" required>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                            </div>
                                           
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-white text-primary btn-block">Enviar</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-white">Já tem uma conta? <a class="text-white" href="login.php">Logar</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>

</body>

</html>