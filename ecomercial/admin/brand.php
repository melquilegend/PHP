<?php 
require_once '../core/int.php';
if (!is_logged_in()) {
	login_error_ridirect();
}
include 'includes/head.php';
include 'includes/navegation.php';
$sql="SELECT * FROM  brand ORDER BY brand";
$results=$db->query($sql);
$errors = array();
//Edit Brand
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	$edit_id = (int)$_GET['edit'];
	$edit_id = sanitize($edit_id);
	$sql2="SELECT * FROM  brand WHERE id='$edit_id'";
	$edit_result = $db->query($sql2);
	$ebrand = mysqli_fetch_assoc($edit_result);

}
//Delete brand
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$delete_id = (int)$_GET['delete'];
	$delete_id = sanitize($delete_id);
	$sql="DELETE FROM  brand WHERE id='$delete_id'";
	$db->query($sql);
	header('Location: brand.php');


}
// if add for is submitted

if (isset($_POST['add_submit'])) {
	$brand = sanitize($_POST['brand']);
	if ($_POST['brand']== '') {
		$errors[].='You must enter a brand';
	}
	// check if brand exist in the data base
	$sql="SELECT * FROM  brand WHERE brand='$brand'";
	if (isset($_GET['edit'])) {
		$sql="SELECT * FROM  brand WHERE brand='$brand' AND id != '$edit_id'";
	}
	$result=$db->query($sql);
	$count = mysqli_num_rows($result);
	if ($count>0) {
		$errors[].=$brand.' already exist! Plese choose another brand name...';
	}
	if (!empty($errors)) {
		echo display_errors($errors);
	}else {
		// add brand to data base
		$sql= "INSERT INTO brand (brand) VALUES ('$brand')";
		if (isset($_GET['edit'])) {
			$sql = "UPDATE brand SET brand ='$brand' WHERE id = '$edit_id'";
		}
		$db->query($sql);
		header('Location: brand.php');


	}
}
?>
<div class="container-fluid">
<h2 class="text-center">Brand</h2>
<!-- brand form-->
<div class="container-fluid">
<div class="row justify-content-center">
<form class="form-inline" action="brand.php<?=((isset($_GET['edit'])))?'?edit='.$edit_id:'';?>" method="post">
 <div class="form-group mb-2">
 
    	<label><?=((isset($_GET['edit'])))?'Edit':'Add New';?> Brand</label>
    </div>
     <div class="form-group mx-sm-3 mb-2">
     		<?php 
     		$brand_value = '';
     	if (isset($_GET['edit'])) {
 		$brand_value = $ebrand['brand'];
 	} else{
 		if (isset($_POST['brand'])) {
 			$brand_value = sanitize($_POST['brand']);
 		}

 	} ?>
      <input type="text" name="brand" id="brand" class="form-control" value="<?=$brand_value; ?>" placeholder="new brand">
        </div>
        <?php if (isset($_GET['edit'])) : ?>
        	<a href="brand.php" class="btn btn-default">Cancel</a>

         <?php endif;  ?>
      <input class="btn btn-success" name="add_submit" type="submit" value="<?=((isset($_GET['edit'])))?'Edit':'Add';?> Brand">
    </div>
  </div>
</form>
</div>

<div class="container">
	<div class="row">
<table class="table table-auto">
  <thead class="thead-dark">
 <th></th><th>Brand</th><th></th>
</thead>
<tbody>
	<?php while ($brand = mysqli_fetch_assoc($results)) : ?>
		<tr>
			<td><a href="brand.php?edit=<?php echo $brand['id']; ?>" class="btn btn-xs btn-default"><i class="fas fa-edit"></i></a></td>
			<td><?php echo $brand['brand'];?> </td>
			<td><a href="brand.php?delete=<?php echo $brand['id']; ?>" class="btn btn-xs btn-default"><i class="fas fa-trash-alt"></i></a></td>


		</tr>
    <?php endwhile; ?>
  </tbody>
</table>
</div>
</div>
</div>
</div>
<?php include 'includes/footer.php';?>