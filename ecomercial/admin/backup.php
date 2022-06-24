<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecomercial/core/int.php';
include 'includes/head.php';
include 'includes/navegation.php';
if (isset($_GET['add'])) {
$brandQuery=$db->query("SELECT * FROM brand ORDER BY brand");
$parentQuery=$db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
$CapacityArray = '';
if ($_POST) {
  $errors=array();
  if (!empty($_POST['Capacity'])) {
    $CapacityString = sanitize($_POST['Capacity']);
    $CapacityString  = rtrim($CapacityString,','); 
    $CapacityArray = explode(',', $CapacityString);
    $cArray = array();
    $qArray = array();
    foreach ($CapacityArray as $cs) {
     $c = explode(':', $cs);
     $cArray[] =$c[0];
     $qArray[] = $c[1];   }
  }else{$CapacityArray = array();}
  $required=Array('title','brand','price','parent','child','Capacity');
  foreach ($required as $fields) {
    if ($_POST[$fields] == '') {
      $errors[] = "All Fields with Astrisk are required.";
      break;

    }
  }
  if ($_FILES['image']['error'] > 0) {
    $errors[] = "The file that you are try to upload is not a image.";
} else {
  if (!empty($_FILES
  )) {
    var_dump($_FILES);
    $photo=$_FILES['image'];
    $name = $photo['name'];
    $nameArray = explode('.', $name);
    $fileName = $nameArray[0];
    $fileExt = $nameArray[1];
    $mime =explode('/', $photo['type']);
    $mimeType= $mime[0];
    $mimeExt = $mime[1];
    $tmpLoc = $photo['tmp_name'];
    $fileSize = $photo['size'];
    $allowed = array('png','jpg','jpeg','gif');
    
    if ($mimeType != 'image') {
      $errors[] = "The file must to be an image.";
    }
    if (!in_array( $fileExt, $allowed)) {
      $errors[] = "The photo extension must to a png, jpg, jpeg or gif.";
    }
 
    if ($fileSize>15000000) {
      $errors[] = "The photo size must to be under 15MB.";
    }
     if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
            $errors[] = 'File extension does not match the file';
        }


  }
}
  if (!empty($errors)) {
   echo display_errors($errors);
  }else{}
}
?>	
<h2 class="text-center"> Add a New Product</h2>
<div class="container-fluid">
<form action="products.php?add=1" method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="title">Title*:</label>
      <input type="text" name="title" class="form-control" id="title" value="<?=((isset($_POST['title']))?sanitize($_POST['title']):'')?>">
    </div>
    <div class="form-group col-md-3">
      <label for="brand">Brand*:</label>
     <select class="form-control" id="brand" name="brand">
     	<option value=""<?=((isset($_POST['brand']) && $_POST['brand']== '' )?' selected':'');?>></option>
     	<?php while ($brand=mysqli_fetch_assoc($brandQuery)): ?>
     	<option value="<?=$brand['id'];?>"<?=((isset($_POST['brand']) && $_POST['brand']== $brand['id'] )?' selected':'');?>><?=$brand['brand'];?></option>

     	<?php endwhile;?>
     	
     </select>
    </div>
    <div class="form-group col-md-3">
      <label for="parent">Parent Category*:</label>
      <select class="form-control" id="parent" name="parent">
      <option value=""<?=((isset($_POST['parent']) && $_POST['parent']=='')?' selected':'');?>></option>
      <?php while ($parent= mysqli_fetch_assoc($parentQuery)):?>
        <option value="<?=$parent['id']?>"<?=((isset($_POST['parent']) && $_POST['parent']==$parent['id'])?' selected':'');?>><?=$parent['category'];?></option>
      <?php endwhile; ?>
      </select>
    </div>
        <div class="form-group col-md-3">
      <label for="child">Child Category*:</label>
      <select class="form-control" id="child" name="child">
      </select>
    </div>
      <div class="form-group col-md-3">
      <label for="price">Price*:</label>
      <input type="text" name="price" class="form-control" id="price" value="<?=((isset($_POST['price']))?sanitize($_POST['price']):'')?>">
    </div>
        <div class="form-group col-md-3">
      <label for="list_prices">List Price:</label>
      <input type="text" name="list_prices" class="form-control" id="list_prices" value="<?=((isset($_POST['list_prices']))?sanitize($_POST['list_prices']):'')?>">
    </div>
    <div class="form-group col-md-3">
    <label >Quantity and Capacity(Size)*:</label>
    <button type="button" onclick="jQuery('#capacityModal').modal('toggle'); return false;" class="btn btn-outline-success">Quantity and Capacity</button>
  </div>
   <div class="form-group col-md-3">
    <label for="Capacity">Capacity & Qty Preview</label>
    <input type="text" name="Capacity" class="form-control" id="Capacity" value="<?=((isset($_POST['Capacity']))?sanitize($_POST['Capacity']):'')?>" readonly>

   </div>
   <div class="form-group col-md-3">
    <label for="image">Product Photo</label>
     <input type="file" name="image" class="form-control" id="image">
  </div>
  <div class="form-group col-md-3">
    <label for="description">Description</label>
     <textarea name="description" class="form-control" rows="6" id="description"><?=((isset($_POST['description']))?sanitize($_POST['description']):'');?></textarea>
  </div>

</div>
<div class="form-group col-md-3 mx-auto ">
<button type="submit" class="btn btn-outline-secondary">Add Product</button>
</div>
</form>

<div  class="modal fade bd-example-modal-lg" id="capacityModal" tabindex="-1" role="dialog" aria-labelledby="capacityModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="capacityModalLabel">Capacity & Quantity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
       <?php for ($i=1; $i <= 12; $i++): ?>
         <div class="form-row">
        <div class="form-group col-md-4">
          <label for="Capacitys<?=$i;?>">Capacity</label>
          <input type="text" name="Capacitys<?=$i;?>" class="form-control" id="Capacitys<?=$i;?>" value="<?=((!empty($cArray[$i-1]))?$cArray[$i-1]:'')?>">
        </div>
        <div class="form-group col-md-2">
          <label for="qty<?=$i;?>">Quantity</label>
          <input type="number" name="qty<?=$i;?>" class="form-control" id="qty<?=$i;?>" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'')?>" min="0">
        </div>

      </div>
       <?php endfor; ?>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateCapacity();jQuery('#capacityModal').modal('toggle'); return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>
<?php }  else{
	$sql = "SELECT * FROM products WHERE deleted = 0";
	$presults = $db->query($sql);
	if (isset($_GET['featured'])) {
	$id = (int)$_GET['id'];
	$featured= (int)$_GET['featured'];
	$featuredsql="UPDATE products SET featured ='$featured' WHERE  id = '$id'";
	$db->query($featuredsql);
	header('Location: products.php');
}
?>
<h2 class="text-center">Products</h2>
<div class="container-fluid">
<a href="products.php?add=1" class="btn btn-success float-right" id="add-product-btn">Add Product</a><div class="clearfix"></div>
<hr>

<table class="table table-sm  table-striped">
 <thead class="thead-dark">
  	<th>Product</th>
  	<th>Price</th>
  	<th>Category</th>
  	<th>Featured</th>
  	<th>Sold</th>
  	<th>Actions</th>
  </thead>
  <tbody>
 <?php while ($product= mysqli_fetch_assoc($presults)): 
 	$childID = $product['categories'];
 	$catsql =  "SELECT * FROM categories WHERE id = $childID";
 	$result= $db->query($catsql);
 	$cat = mysqli_fetch_assoc($result);
 	$parentID = $cat['parent'];
 	$psql =  "SELECT * FROM categories WHERE id = $parentID";
 	$presult= $db->query($psql);
 	$parent = mysqli_fetch_assoc($presult);
 	$category = $parent['category'].'-'.$cat['category'];


 	?>
 	<tr>
 		<td><?=$product['title']?></td>
 		<td><?=money($product['price'])?></td>
 		<td><?=$category?></td>
 		<td><a href="products.php?featured=<?=(($product['featured']== 0)?'1':'0')?>&id=<?=$product['id']?>" class="btn btn-xs btn-default"><i class="fas fa-<?=(($product['featured']==1)?'minus-circle':'plus-circle');?>"></i>
 		</a> &nbsp <?=(($product['featured']==1)?'Featured Products':'');?></td>
 		<td></td>
 		<td><a href="products.php?edit=<?=$product['id']?>" class="btn btn-xs btn-default"><i class="fas fa-edit"></i></a>
 		<a href="products.php?delete=<?=$product['id']?>" class="btn btn-xs btn-default"><i class="fas fa-trash-alt"></i></a></td>
 	</tr>
 <?php endwhile;?>
  </tbody>
</table>
</div>


<?php } include 'includes/footer.php'; ?>