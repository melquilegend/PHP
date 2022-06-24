<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php';
unset($_SESSION['SBuser']);
header('Location: login.php');


?>