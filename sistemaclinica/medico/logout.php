<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php';
unset($_SESSION['SBmedico']);
header('Location: login.php');


?>