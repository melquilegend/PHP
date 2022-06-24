<?php 

	if (isset($_GET['loggout'])) {
	Painel::loggout();
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Painel de Controle</title>
	<link rel="stylesheet" href="estilo/fontawesome.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100;8..144,400;8..144,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL;?>css/painel.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Descrição do meu website">
	<meta name="keywords" content="palavras-chave, do, meu,site">
	<script src="https://kit.fontawesome.com/edcc44cc2c.js" crossorigin="anonymous"></script>
</head>
<body>
	<aside>
		<div class="aside-wraper">
		<div class="box-usuario">
			<?php 
			     if ($_SESSION['img']=='') {
			     	
			?>
			<div class="avatar-usuario">
				<i class="fa fa-user"></i>
			</div>
			  <?php } else{?>
			  	<div class="imagem-usuario">
				<img src="<?php echo INCLUDE_PATH_PAINEL;?>uploads/<?=$_SESSION['img'];?>" />
			</div>
			   <?php }?>
			<div class="nome-usuario">
				<p><?=$_SESSION['nome'];?></p>
				<span><?=pegaCargo($_SESSION['cargo']);?></span>
			</div>
		</div>
		<div class="items-menu"></div>
		</div>
	</aside>
		<header>
			<div class="center">
				<div class="menu-btn">
					<i class="fa fa-bars"></i>
				</div>
			<div class="loggout">
				<a href="<?php echo INCLUDE_PATH_PAINEL;?>?loggout"><i class="fa fa-window-close"></i></a>
			</div>
			<div class="clear"></div>
			</div>
		</header>
		<div class="content">
			<div class="box-content left w100">
				
			</div>
			<div class="clear"></div>
		</div>
	</div>
	</div>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH;?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL;?>js/painel.js"></script>
</body>
</html>