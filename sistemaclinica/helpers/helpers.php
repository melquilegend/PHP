<?php
function display_errors($errors)
{
	$display = '<ul class="text-danger">';
	foreach ($errors as $error) {
		$display .='<li>'.$error.'</li>';
	}
	$display .='</ul>';
	return $display;
}
function sanitize($dirty)
{
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}
function formatdate($date)
{
	setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');
	//return date("M d, Y h:i A", strtotime($date));
	//return date("F jS, Y",strtotime($date));
	//return date("M d, Y ",strtotime($date));
	return date('d/m/y',strtotime($date));
}
function login($user_id){

	$_SESSION['SBuser']=$user_id;
	global $db;
	$date= date("Y-m-d H:i:s");
	$db->query("UPDATE users SET last_login = '$date' WHERE id ='$user_id'");
	$_SESSION['success_flash']= 'Agora você está logado! Bem vindo ao Sistema(^ ^)';
	echo "<script>alert('Agora você está logado! Bem vindo ao Sistema'); window.location = './index.php';</script>";
	//header('Location:index.php');
}
function patient_login($user_id){

	$_SESSION['SBpatient']=$user_id;
	global $db;
	$date= date("Y-m-d H:i:s");
	$db->query("UPDATE patient SET last_login = '$date' WHERE id ='$user_id'");
	$_SESSION['success_flash']= 'Agora você está logado! Bem vindo ao Sistema(^ ^)';
	echo "<script>alert('Agora você está logado! Bem vindo ao Sistema'); window.location = './index.php';</script>";
	//header('Location:index.php');
}
function medico_login($user_id){

	$_SESSION['SBmedico']=$user_id;
	global $db;
	$date= date("Y-m-d H:i:s");
	$db->query("UPDATE doctores SET last_login = '$date' WHERE id ='$user_id'");
	$_SESSION['success_flash']= 'Agora você está logado! Bem vindo ao Sistema(^ ^)';
	echo "<script>alert('Agora você está logado! Bem vindo ao Sistema'); window.location = './index.php';</script>";
	//header('Location:index.php');
}
function is_logged_in_p()
{
	if (isset($_SESSION['SBpatient']) && $_SESSION['SBpatient'] > 0) {
		return true;
	}
	return false;
}
function is_logged_in_m()
{
	if (isset($_SESSION['SBmedico']) && $_SESSION['SBmedico'] > 0) {
		return true;
	}
	return false;
}
function is_logged_in()
{
	if (isset($_SESSION['SBuser']) && $_SESSION['SBuser'] > 0) {
		return true;
	}
	return false;
}
function login_error_ridirect($url='login.php')
{
	$_SESSION['error_flash']='Para ter acesso a páginas tens de esta logado';
	header('Location:'.$url);
}
function permission_error_redirect($url='medico/index.php')
{
	$_SESSION['error_flash']='Você não tem permissão para acessar essa página';
	header('Location:'.$url);
}
function has_permission($permission = 'admin')
{
	global $user_data;
	$permissions=explode(',', $user_data['permissions']);
	if (in_array($permission, $permissions,true)) {
		return true;
	}
	return false;
}