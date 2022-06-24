<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecomercial/core/int.php';
$name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$country= sanitize($_POST['country']);
$city = sanitize($_POST['city']);
$state = sanitize($_POST['state']);
$street= sanitize($_POST['street']);
$street2 = sanitize($_POST['street2']);
$zip_code = sanitize($_POST['zip_code']);
$errors = array();

$required = array(
'full_name'=>'Full Name',
'email'=>'Email',
'country'=>'Country',
'city'=>'City',
'state'=>'State',
'street'=>'Street Address',
'zip_code'=>'Zip Code',
);
foreach ($required as $f => $d) {
	if (empty($_POST[$f]) || $_POST[$f]=='') {
		$errors[]=$d.' Is required.';
	}
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors[]='Enter Valid email.';
}
if (!empty($errors)) {
	echo display_errors($errors);
	}else{
		echo 'passed';
	}


?>