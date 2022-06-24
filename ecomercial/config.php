 <?php 
define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/ecomercial/');

define('CART_COOKIE', 'SBwiz223ertyGHwiz321');
define('CART_COOKIE_EXPIRE',  time() + (86400 *30));
define('TAXRATE', 0.015);
define('CURRENCY', 'usd');
define('CHECKOUTMODE', 'TEST'); //DON'T FORGET TO CHANGE THIS TO LIVE WHEN YOU NEED
if (CHECKOUTMODE=='TEST') {
	define('STRIPE_PRIVATE', 'sk_test_5HnMjNmWkJmhWgbQZ01hIa3h');
	define('STRIPE_PUBLIC', 'pk_test_gpkdCLitWf64tDSAddrbfbV2');
}
if (CHECKOUTMODE=='LIVE') {
	define('STRIPE_PRIVATE', '');
	define('STRIPE_PUBLIC', '');
}

 ?>