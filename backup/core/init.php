<?php

$db=mysqli_connect('localhost','root','root','clinicasistema');
if (mysqli_connect_errno()) {
	echo 'Database connection failel with following errors: '.mysqli_connect_error();
	die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/config.php';
require_once BASEURL.'/helpers/helpers.php';
if (isset($_SESSION['SBuser'])) {
	$user_id =$_SESSION['SBuser'];
	$query=$db->query("SELECT * FROM users WHERE id ='$user_id'");
	$user_data = mysqli_fetch_assoc($query);
	
}
if (isset($_SESSION['SBpatient'])) {
	$user_id =$_SESSION['SBpatient'];
	$query=$db->query("SELECT * FROM patient WHERE id ='$user_id'");
	$user_data = mysqli_fetch_assoc($query);
	
}
if (isset($_SESSION['SBmedico'])) {
	$user_id =$_SESSION['SBmedico'];
	$query=$db->query("SELECT * FROM doctores WHERE id ='$user_id'");
	$user_data = mysqli_fetch_assoc($query);
	
}


if (isset($_SESSION['success_flash'])) {
	echo '<div class="alert alert-success" role="alert"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
	unset($_SESSION['success_flash']);
}
if (isset($_SESSION['error_flash'])) {
	echo '<div class="alert alert-danger" role="alert"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
	unset($_SESSION['error_flash']);
	}