<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php';
$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email=trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password=trim($password);
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
                                    <form action="login.php" method="post">
                                        <?php
                                            if($_POST){
                                                if (empty($_POST['email']) || empty($_POST['password'])){

                                                  $errors[] = "Você deve fornecer Email & Senha.";
                                                }
                                                if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                                                   $errors[] = "email invalido";
                                                }
                                                if (strlen($password)<6) {
                                                   $errors[] = "A senha tem de conter mais de 6 caracteres";
                                                }
                                                $query=$db->query("SELECT * FROM patient WHERE email = '$email'");
                                                $user=mysqli_fetch_assoc($query);
                                                //var_dump($user);
                                                $userCount = mysqli_num_rows($query);
                                                if ($userCount<1) {
                                                  $errors[] = "Verifique a senha ou email";
                                                }
                                                if (!password_verify($password, $user['password'] ?? null)) {
                                                  $errors[] = "Verifique a senha ou email";
                                                }
                                                 //if ($user['permissions'] = 'admin,editor') {
                                                  //$errors[] = "Por favor faça o login no panel administrativo";
                                                //}
                                                

                                              


                                                if (!empty($errors)) {
                                                 echo display_errors($errors);
                                                }else{
                                                  $user_id=$user['id'];
                                                  patient_login($user_id);

                                                }



                                            }

                                            ?>
                                             <?php $errors = array();?>
                                        <div class="form-group" data-validate = "Valid email is required: ex@abc.xyz">
                                            <label class="mb-1 text-white"><strong>Email</strong></label>
                                            <input type="email" name="email" value="<?=$email;?>" class="form-control" required>
                                        </div>
                                        <div class="form-group" data-validate = "Valid email is required: ex@abc.xyz">
                                            <label class="mb-1 text-white"><strong>Senha</strong></label>

                                            <input type="password" name="password" value="<?=$password;?>" class="form-control" required>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                            </div>
                                            <div class="form-group">
                                                <a class="text-white" href="#">Esqueceu a senha?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-white text-primary btn-block">Logar</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-white">Não tem uma conta? <a class="text-white" href="inscrever.php">Inscrever-se</a></p>
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