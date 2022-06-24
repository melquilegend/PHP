<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecomercial/core/int.php';
unset($_SESSION['SBuser']);
header('Location: login.php');


?>