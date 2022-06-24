<?php
require_once'../core/int.php';
if(isset($_POST["id"])){
    $id = $_POST["id"];
}else{
    $id = NULL;
}
$id = (int)$id;
$sql="SELECT * FROM  products WHERE id='$id'";
$result=$db->query($sql);
$product = mysqli_fetch_assoc($result);
$brand_id = $product['brand'];
$sql="SELECT brand FROM  brand WHERE id='$brand_id'";
$brand_query=$db->query($sql);
$brand = mysqli_fetch_assoc($brand_query);
$sizestring = $product['Capacity'];
$sizestring = rtrim($sizestring,',');
$size_array = explode(',',$sizestring);
?>


<?php ob_start();?>
<div class="modal fade" id="details-model"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $product['title'];?></h5><hr>
        <p class="text-center" id="modal_errors"></p>
        <button type="button"  class="close" onclick="closeModal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-4">
            <div class="center-block">
            <img src="<?php echo $product['image'];?>" align="left" width="237" height="363" alt="<?php echo $product['title'];?>" class="details img-responsive" >
            </div>
          </div>
          <div class="col-md-5 ml-auto">           
            <h5>Details</h5>
            <p><?php echo nl2br($product['description']);?></p>
            <p>Price: $ <?php echo $product['price'];?></p>
            <p>Brand: <?php echo $brand['brand'];?></p>
            <form action="add_cart.php" method="post" id="add_product_form">
               <input type="hidden" name="product_id"  value="<?=$id?>">
              <input type="hidden" name="available" id="available" value="">
              <div class="form-group">
              <div class="col-xs-3">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity">                
              </div>              
              </div>
              <div class="form-group">
                <label for="capacity">Capacity</label>
                <select name="Capacity" id="capacity" class="form-control">
                  <option value=""></option>
                  <?php foreach ($size_array as $string) {
                    $string_array = explode(':', $string);
                    $capacity = $string_array[0];
                    $available = $string_array[1];
                    echo '<option value="' .$capacity. '" data-available="'.$available.'"> ' .$capacity. ' ( ' .$available. ' Available)</option>';
                  }?>               
                  

                </select>
              </div>
              
            </form>
          </div>
      </div>
    </div>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="closeModal()">Close</button>
        <button  class="btn btn-warning"  onclick="add_to_cart(); return false;"><i class="fas fa-shopping-cart"></i>Add to cart</button>
      </div>
    </div>
  </div>
</div>
<script>
jQuery("#capacity").change(function(){  
    var available = jQuery("#capacity option:selected").data("available");
    jQuery("#available").val(available);


})
function closeModal() {
jQuery('#details-model').modal('hide');
setTimeout(function() {
  jQuery('#details-model').remove();
},500);
}
</script>
<?php echo ob_get_clean(); ?>
