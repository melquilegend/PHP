<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>ECITES ELETRONICO</title>
	<link rel="stylesheet" href="estilo/fontawesome.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100;8..144,400;8..144,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH;?>estilo/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Descrição do meu website">
	<meta name="keywords" content="palavras-chave, do, meu,site">
	<script src="https://kit.fontawesome.com/edcc44cc2c.js" crossorigin="anonymous"></script>
</head>
<body>
	<base base="<?php echo INCLUDE_PATH;?>">
	<?php 
	$url = isset($_GET['url']) ? $_GET['url'] : 'home';
	switch ($url) {
		case 'sobre':
			echo '<target target="sobre" />';
			break;
		case 'servicos':
			echo '<target target="servicos" />';
			break;
	}
	?>
	<div class="sucesso">
		Formulario enviado com sucesso
	</div>
	
	<div class="overlay-loading">
		<img src="<?php echo INCLUDE_PATH;?>images/ajax-loader.gif">
	</div>
	<header>
		<div class="center">
		<div class="logo left"><a href="<?php echo INCLUDE_PATH;?>">Logo Marca</a></div>
		<nav class="desktop right">
			<ul>
				<li><a href="<?php echo INCLUDE_PATH;?>">Inicio</a></li>
				<li><a href="<?php echo INCLUDE_PATH;?>sobre">Sobre</a></li>
				<li><a href="<?php echo INCLUDE_PATH;?>servicos">Serviços</a></li>
				<li><a realtime="contacto" href="<?php echo INCLUDE_PATH;?>contacto">Contactos</a></li>
			</ul>
		</nav>
		<nav class="mobile right">
			<div class="botao-menu-mobile">
			<i class="fa-solid fa-bars"></i>
			</div>
			<ul>
				<li><a href="<?php echo INCLUDE_PATH;?>">Inicio</a></li>
				<li><a href="<?php echo INCLUDE_PATH;?>sobre">Sobre</a></li>
				<li><a href="<?php echo INCLUDE_PATH;?>servicos">Serviços</a></li>
				<li><a realtime="contacto" href="<?php echo INCLUDE_PATH;?>contacto">Contactos</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
		</div>
	</header>
	<div class="container-principal">
	<?php 
	if (file_exists('pages/'.$url.'.php')) {
		include 'pages/'.$url.'.php';
	}else{
		if ($url != 'sobre' &&  $url != 'servicos' ) {
			
			include 'pages/404.php';
		}else{
			include 'pages/home.php';
		}
		
	}

	?>
	</div>
	<footer>
		<p>Todos os direitos reservados</p>
	</footer>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH;?>js/jquery.js"></script>
	<script type="text/javascript"  src="<?php echo INCLUDE_PATH;?>js/script.js"></script>
	<script type="text/javascript"  src="<?php echo INCLUDE_PATH;?>js/slider.js"></script>
	<script type="text/javascript"  src="<?php echo INCLUDE_PATH;?>js/constantes.js"></script>
	<script type="text/javascript"  src="<?php echo INCLUDE_PATH;?>js/formularios.js"></script>
</body>
</html>