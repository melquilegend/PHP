<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php';
unset($_SESSION['SBpatient']);
header('Location: login.php');


?>