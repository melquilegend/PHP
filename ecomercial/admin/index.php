<?php 
require_once '../core/int.php';
if (!is_logged_in()) {
	login_error_ridirect();
}

include 'includes/head.php';
include 'includes/navegation.php';

?>
<div class="container-fluid">
Administrator home
</div>

<?php include 'includes/footer.php';?>