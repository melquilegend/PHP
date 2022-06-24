<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecomercial/core/int.php';
if (!is_logged_in()) {
	login_error_ridirect();
}
include 'includes/head.php';
include 'includes/navegation.php';
// delet product
if (isset($_GET['restore'])) {
$id= sanitize($_GET['restore']);
$db->query("UPDATE products SET deleted = 0  WHERE  id='$id'");
header( 'Location:products_restoure.php');
}
?>
<?php

	$sql = "SELECT * FROM products WHERE deleted = 1";
	$presults = $db->query($sql);
	if (isset($_GET['featured'])) {
	$id = (int)$_GET['id'];
	$featured= (int)$_GET['featured'];
	$featuredsql="UPDATE products SET featured ='$featured' WHERE  id = '$id'";
	$db->query($featuredsql);
	header('Location: products.php');
}
?>
<div class="container-fluid">
<h2 class="text-center">Products Trash</h2>
<div class="container-fluid">
<div class="clearfix"></div>
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
 	$catsql =  "SELECT * FROM categories WHERE id = '$childID'";
 	$result= $db->query($catsql);
 	$cat = mysqli_fetch_assoc($result);
 	$parentID = $cat['parent'];
 	$psql =  "SELECT * FROM categories WHERE id = '$parentID'";
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
 		<td>
 		<a href="products_restoure.php?restore=<?=$product['id']?>" class="btn btn-xs btn-default"><i class="fas fa-sync-alt"></i></a></td>
 	</tr>
 <?php endwhile;?>
  </tbody>
</table>
</div>
</div>
<?php include 'includes/footer.php'; ?>