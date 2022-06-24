<?php
require_once 'core/int.php';
include  'includes/head.php';
include  'includes/navbar.php';
include  'includes/banner.php';
if ($cart_id != '') {
	$cartQ = $db->query("SELECT * FROM cart WHERE id='{$cart_id}'");
	$result=mysqli_fetch_assoc($cartQ);
	$items=json_decode($result['items'], true); 
	$i=1;
	$sub_total=0;
	$item_count = 0;
}
?>
<div class="container-fluid">
  <div class="row">
  	<div class="col-md-12">
  		<h2 class="text-center"> My Shoppin cart</h2>
  		<?php if ($cart_id== ''):?>
  			<div class="bg-danger text-white">
  				<p class="text-center"> Your  Shopping cart is empty continue </p>
  			</div>
  		<?php else: ?>
  		<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Items</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Capacity</th>
      <th scope="col">Sub total</th>
    </tr>
  </thead>
  <tbody>
  	<?php

  	foreach($items as $item) {
 // ...
 			$product_id = $item['id'];
    		$productQ = $db->query("SELECT * FROM products WHERE id='{$product_id}'");
    		$product = mysqli_fetch_assoc($productQ);
    		$carray = explode(',',$product['Capacity']);
    		foreach ($carray as $capacityString ) {
    		 	$c= explode(':', $capacityString);
    		 	if ($c[0]==$item['Capacity'] ) {
    		 		$available = $c[1];
    		 	}
    		 }
  ?>  	
   <tr>
    <th scope="row"><?=$i;?></th>
      <td><?=$product['title'];?></td>
      <td><?=money($product['price']);?></td>
      <td><button class="btn btn-outline-primary btn-sm" onclick="update_cart('removeone','<?=$product['id'];?>','<?=$item['Capacity'];?>');">-</button>
        <?=$item['quantity'];?>
      <?php if ($item['quantity']<$available): ?>
      <button  onclick="update_cart('addone','<?=$product['id'];?>','<?=$item['Capacity'];?>');" class="btn btn-outline-primary btn-sm">+</button>
    <?php else:?>

      <span class="text-danger">Max</span>
    <?php endif; ?>
        </td>
      <td><?=$item['Capacity'];?></td>
      <td><?=money($item['quantity'] * $product['price']);?></td>
    </tr> 
  <?php 
  $i++;
  $item_count += $item['quantity'];
  $sub_total += ($product['price'] * $item['quantity']);
}
if ($sub_total > 50001) {
	$tax=TAXRATE * $sub_total;
}else{
	$tax=0.00;
}

$tax= number_format($tax,2);
$grand_total = $tax + $sub_total;

 ?>
</table>
<table class="table table-bordered">
	<legend>Total</legend>
  <thead>
    <tr>
      <th scope="col">Total Items</th>
      <th scope="col">Sub Total</th>
      <th scope="col">Tax</th>
      <th scope="col">Grand Total</th>
    </tr>
  </thead>
  <tbody>
  	<tr>
  		<td><?=$item_count;?></td>
  		<td><?=money($sub_total);?></td>
  		<td><?=money($tax);?></td>
  		<td class="bg-success"><?=money($grand_total);?></td>
  	</tr>
  </tbody>
</table>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Check out</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modallabel">Shipping Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="thankyou.php" method="post" id="payment-form">
          <input type="hidden" name="tax" value="<?=$tax;?>">
          <input type="hidden" name="sub_total" value="<?=$sub_total;?>">
          <input type="hidden" name="grand_total" value="<?=$grand_total;?>">
          <input type="hidden" name="cart_id" value="<?=$cart_id;?>">
          <input type="hidden" name="description" value="<?=$item_count.' item'.(($item_count>1)?'s':'').' from ecomercial';?>">
          <span class="bg-danger" id="payment-errors"></span>
        <div id="step1" style="display: block;">
          <div class="row">
          <div class="form-group col-md-6">
            <label for="full_name">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name">
          </div>
           <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
           <div class="form-group col-md-6">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country" data-stipe="address_country">
          </div>
          <div class="form-group col-md-6">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" data-stipe="address_city">
          </div>
           <div class="form-group col-md-6">
            <label for="state">State</label>
            <input type="text" class="form-control" id="state" name="state" data-stipe="address_state">
          </div>
           <div class="form-group col-md-6">
            <label for="street">Street Address</label>
            <input type="text" class="form-control" id="street" name="street" data-stipe="address_line1">
          </div>
           <div class="form-group col-md-6">
            <label for="street2">Street Address 2</label>
            <input type="text" class="form-control" id="street2" name="street2" data-stipe="address_line2">
          </div>
       
           <div class="form-group col-md-6">
            <label for="zip_code">Zip Code</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" data-stipe="address_zip">
          </div>
          
        </div>
        </div>
  <div id="step2" style="display: none;">
    <label for="card-element">
      Credit or debit card
    </label>
    <div class="form-control" id="card-element">
      <!-- a Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors -->
    <div id="card-errors" role="alert"></div>
  </div>


  
  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="check_address();" id="next_button">Next</button>
        <button type="button" class="btn btn-primary" onclick="back_address();" id="back_button" style="display: none;">Back</button>
        <button type="submit" class="btn btn-primary" id="check_out_button" style="display: none;">Chek Out</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
  	</div>
  </div>
</div>

<script>
  function back_address(){
      jQuery('#payment-errors').html("");
      jQuery('#step1').css("display","block");
      jQuery('#next_button').css("display","block");
      jQuery('#step2').css("display","none");
      jQuery('#back_button').css("display","none");
      jQuery('#check_out_button').css("display","none");
      jQuery('#modallabel').html("Shipping Address");



  }
  function check_address(){
    var data =
    {
      'full_name':jQuery('#full_name').val(),
      'email':jQuery('#email').val(),
      'country':jQuery('#country').val(),
      'city':jQuery('#city').val(),
      'state':jQuery('#state').val(),
      'street':jQuery('#street').val(),
      'street2':jQuery('#street2').val(),
      'zip_code':jQuery('#zip_code').val(),
    };
    jQuery.ajax({

     url:'/ecomercial/admin/parsers/check_address.php',
    method: 'post',
      data: data,
    success: function(data){
        if(data != 'passed') {
          jQuery('#payment-errors').html(data);
        }
        if(data.trim() == 'passed') {

          jQuery('#payment-errors').html("");
          jQuery('#step1').css("display","none");
          jQuery('#next_button').css("display","none");
          jQuery('#step2').css("display","block");
          jQuery('#back_button').css("display","inline-block");
          jQuery('#check_out_button').css("display","inline-block");
          jQuery('#modallabel').html("Enter Your Card Details");
        }

    }, 
    error:function(){alert("something went wrong!")},


    });


  }
  var stripe = Stripe('<?=STRIPE_PUBLIC?>');
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>

<?php 
include  'includes/footer.php';
 ?>