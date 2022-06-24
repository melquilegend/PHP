<?php
	include('../config.php');
	$data = array();
	$assunto = 'Novo mensagem do site!';
	$corpo = '';
	foreach ($_POST as $key => $value) {
		$corpo.=ucfirst($key).": ".$value;
		$corpo.="<hr>";
	}
	$info = array('assunto'=>$assunto,'corpo'=>$corpo);
	$mail = new Email('smtp.hostinger.com','webmaster@melquivunge.com','1993Mixmasters$','INBC');
	$mail->addAdress('webmaster@melquivunge.com','Melqui');
	$mail->formatarEmail($info);
	if($mail->enviarEmail()){
		$data['sucesso'] = true;
	}else{
		$data['erro'] = true;
	}



	//$data['retorno'] = 'sucesso';

	die(json_encode($data));
?>