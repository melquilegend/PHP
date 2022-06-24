<?php
/*
$product_id = sanitize($_POST['product_id']);
$capacity = sanitize($_POST['capacity']);
$available = sanitize($_POST['available']);
$quantity = sanitize($_POST['quantity']);
$item=array();
$item[]=array(
'id' => $product_id,
'capacity' =>$capacity,
'quantity' => $quantity,
);
$domain=($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
$query=$db->query("SELECT * FROM products WHERE id = '{$product_id}'");
$product = mysqli_fetch_assoc($query);
$_SESSION['success_flash']= $product['title'].'added to your cart';
//check  if the cart cookie exists
if ($cart_id != '') {
	$cartQ=$db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
	$cart = mysqli_fetch_assoc($cartQ);
	$previous_items = json_encode($cart['items'],true);
	$item_match=0;
	$new_items = array();
	foreach ($previous_items as $pitem) {
		if ($item[0]['id']==$pitem['id'] && $item[0]['capacity'] == $pitem['capacity']) {
			$pitem['quantity']= $pitem['quantity'] + $item[0]['quantity'];
			if ($pitem['quantity']>$available) {
				$pitem['quantity'] = $available;
			}
			$item_match=1;
		}
		$new_items[]=$pitem;
	}
	if ($item_match !=1) {
		$new_items = array_merge($item,$previous_items);
	}
	$items_json = json_encode($new_items);
	$cart_expire = date("Y-m-d H-i:s",strtotime("+30 days"));
	$db->query("UPDATE cart SET  items='{$items_json}', expire_date='{$cart_expire}' WHERE id = '{$cart_id}'");
	setcookie(CART_COOKIE,'',1,'/',$domain = false);
	setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/', $domain = false);

}else{
	$items_json=json_encode($item);
	$cart_expire = date("Y-m-d H-i:s",strtotime("+30 days"));
	$db->query("INSERT INTO cart (items,expire_date) VALUES('{$items_json}','{$cart_expire}')");
	$cart_id = $db->insert_id;
	setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/', $domain = false);
}
*/?>
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecomercial/core/int.php';
$product_id = sanitize($_POST['product_id']);
$capacity = sanitize($_POST['Capacity']);
$available = sanitize($_POST['available']);
$quantity = sanitize($_POST['quantity']);
$items = array();
$items[] = array(
    'id'       => $product_id,
    'Capacity'     => $capacity,
    'quantity' => $quantity,
);

$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
$query = $db->query("select * from products where id='{$product_id}'");
$product = mysqli_fetch_assoc($query);
$_SESSION['success_flash'] = $product['title']. ' Added to your product into cart';

//check if the cart cookire exist
if ($cart_id != ''){
    $cartQ = $db->query("select * from cart where id='{$cart_id}'");
    $cart = mysqli_fetch_assoc($cartQ);
    $previous_items = json_decode($cart['items'], true);
    $items_match = 0;
    $new_items = array();
    foreach ($previous_items as $pitems){
        if ($items[0]['id'] == $pitems['id'] && $items[0]['Capacity'] == $pitems['Capacity']){
            $pitems['quantity'] = $pitems['quantity'] + $items[0]['quantity'];
            if ($pitems['quantity'] > $available){
                $pitems['quantity'] = $available;
            }
            $items_match = 1;
            
        }
        $new_items[] = $pitems;
    }
    if ($items_match != 1){
        $new_items = array_merge($items,$previous_items);
    }
    $items_json = json_encode($new_items);
    $cart_expire = date("Y-m-d H:i:s",  strtotime("+30 days"));
    $db->query("update cart set items='{$items_json}', expire_date='{$cart_expire}' where id='{$cart_id}'");
    setcookie(CART_COOKIE,'',1,"/",$domain,false);
    setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
}  else {
     //add the cart to database and set cookie
    $items_json = json_encode($items);
    $cart_expire = date("Y-m-d H:i:s",  strtotime("+30 days"));
    $db->query("insert into cart(items,expire_date) values('{$items_json}','{$cart_expire}')");
    $cart_id = $db->insert_id;
    setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
}
?>