</body>
<!-- footer -->
<!-- <footer class="footer">
      <div class="container">
        <span class="text-muted">&copy; Copyright 2018 Ecomercia</span>
      </div>
 </footer>-->
<script>
function updateCapacity(){
var CapacityString ='';
for (var i = 1; i <= 12; i++) {
	if (jQuery('#Capacitys'+i).val() != '') {
	CapacityString += jQuery('#Capacitys'+i).val()+':'+jQuery('#qty'+i).val()+',';	
	}
}
jQuery('#Capacity').val(CapacityString);

}

	function get_child_options(selected) {
		if (typeof selected === 'undefined') {
			var selected = '';


		}
		var parentID = jQuery('#parent').val();
		jQuery.ajax({
			url:'/ecomercial/admin/parsers/child_categories.php',
			type: 'POST',
			data:{parentID : parentID, selected: selected},
			success: function(data){
				jQuery('#child').html(data)
			},
			error: function(){alert("Something went wrong with the child option.")},
		})
	}
	jQuery('select[name="parent"]').change(function(){
		get_child_options();
	});

</script>

  <script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
  <script src="js/vendor/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>