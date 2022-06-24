<!doctype html>
<html lang="en">
  <head>
  	<title>Painel de Controle</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL;?>css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Efetuar o Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
						<?php

							if (isset($_POST['entrar'])) {
								$email = $_POST['email'];
								$senha = $_POST['senha'];
								$sql = MySql::conectar()->prepare("SELECT * FROM `admin_db` WHERE email = ? AND password = ?");
								$sql ->execute(array($email,$senha));
								if ($sql->rowCount()== 1) {
									$info = $sql->fetch();
									$_SESSION['login'] = true;
									$_SESSION['email'] = $email;
									$_SESSION['password'] =$senha;
									$_SESSION['nome'] = $info['nome'];
									$_SESSION['usuario'] = $info['usuario'];
									$_SESSION['cargo'] = $info['cargo'];
									$_SESSION['img'] = $info['img'];
									header('Location: '.INCLUDE_PATH_PAINEL);
									die();

								}else{

									echo '<div class="erro-box">Usuario ou senha Incorretos</div>';

								}
							}

						?>
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
						<form method="post" class="login-form">
		      		<div class="form-group">
		      			<input type="email" class="form-control rounded-left" name="email" placeholder="email" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" name="senha" placeholder="Senha" required>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
	            		<label class="checkbox-wrap checkbox-primary">Lembrar de mim
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#">Esqueceu a Senha?</a>
								</div>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5" name="entrar">Entrar</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>
u931750607_0UBVa

