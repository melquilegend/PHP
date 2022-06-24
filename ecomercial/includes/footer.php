

<!-- footer -->
 <footer class="footer">
      <div class="container">
        <span class="text-muted">&copy; Copyright 2018 Ecomercia</span>
      </div>
    </footer>
<script>
function detailsmodal(id) {
 var data ={"id":id}; 
 jQuery.ajax({ 
 	url:'/ecomercial/includes/modal.php', 
 	method : "post", 
 	data : data, 
 	success: function (data) {
 	 jQuery('body').prepend(data); 
 	 jQuery('#details-model').modal('toggle'); }, 
 	 error: function () {
 	  alert("something went wrong"); 
 	} 
 }); 
}
function update_cart(mode,edit_id,edit_capacity){
	var data={"mode":mode, "edit_id":edit_id, "edit_capacity":edit_capacity}
	jQuery.ajax({
		url:'/ecomercial/admin/parsers/update_cart.php',
		method:"post",
		data:data,
		  success: function(){
		  	location.reload();
		  }, 
		error:function(){alert("something went wrong!")},

	});


}

function add_to_cart(){

	jQuery('#modal_errors').html("");
	var capacity = jQuery("#capacity").val();
	var quantity = jQuery("#quantity").val();
	var available =jQuery("#available").val();
	var error ='';
	var data = jQuery("#add_product_form").serialize();
	if (capacity == '' || quantity=='' || quantity ==0) {
		error += '<p class="text-danger text-center">You must choose a capacity and quantity</p>'
		jQuery('#modal_errors').html(error);
		return;
	}else if (quantity > available) {

		error += '<p class="text-danger text-center">There are only '+available+' available </p>'
		jQuery('#modal_errors').html(error);
		return;
	}else{

		jQuery.ajax({
		  url:'/ecomercial/admin/parsers/add_cart.php',
		  method: 'post',
		  data: data,
		  success: function(){
		  	location.reload();
		  }, 
 	 error: function () {alert("something went wrong");}
	});

	}
}
</script>

    <script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>