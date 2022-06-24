<?php
require_once 'core/int.php';
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_test_5HnMjNmWkJmhWgbQZ01hIa3h");

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$full_name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$country= sanitize($_POST['country']);
$city = sanitize($_POST['city']);
$state = sanitize($_POST['state']);
$street= sanitize($_POST['street']);
$street2 = sanitize($_POST['street2']);
$zip_code = sanitize($_POST['zip_code']);
$tax = sanitize($_POST['tax']);
$sub_total = sanitize($_POST['sub_total']);
$grand_total = sanitize($_POST['grand_total']);
$cart_id = sanitize($_POST['cart_id']);
$description = sanitize($_POST['description']);
$charge_amount = $grand_total;
$metadata= array(
"cart_id" => $cart_id,
"tax" =>$tax,
"sub_total" => $sub_total
);
$customer = \Stripe\Customer::create([
"email" =>$email,
"source" => $token

]);
$charge = \Stripe\Charge::create([
    'amount' => $charge_amount,
    'currency' => 'usd',
    'description' => $description,
    // only in live mode
    'receipt_email' => $email,
    'metadata' => $metadata,
    "customer" => $customer->id
]);
$db->query("UPDATE cart SET paid = 1 WHERE id = '{$cart_id}'");
$db->query("INSERT INTO transactions (charge_id,cart_id,full_name,email,country,city,state,street,street2,zip_code,tax,sub_total,grand_total,description,txn_type) VALUES('$charge->id','$cart_id','$full_name','$email','$country','$city','$state','$street','$street2','$zip_code','$tax','$sub_total','$grand_total','$description','$charge->object')");
$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
setcookie(CART_COOKIE,'',1,"/",$domain,false);
include  'includes/head.php';
include  'includes/navbar.php';
include  'includes/banner.php';
?>
<h1 class="text-center text-success">Thanks For Shopping here</h1>
<p>You card has been successfully charged: <?=$grand_total;?>. You have been emailed a receip. please check your span box if is not in your inbox. Addictionally you can print this page as a receip.</p>
<p>Your receip number is: <strong><?=$cart_id;?></strong></p>
<p>Your order will be shipped to the address below.</p>
<address>
	<?=$full_name;?><br>
	<?=$street;?><br>
	<?=$country;?><br>
	<?=$city.', '.$state.', '.$zip_code;?><br>



</address>
<?php 
include  'includes/footer.php';
 ?>