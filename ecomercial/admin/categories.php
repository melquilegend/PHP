<?php  
require_once $_SERVER['DOCUMENT_ROOT'].'/ecomercial/core/int.php';
if (!is_logged_in()) {
	login_error_ridirect();
}
include 'includes/head.php';
include 'includes/navegation.php';

$sql="SELECT * FROM categories WHERE parent = 0";
$result = $db->query($sql);
$errors = array();
$category = '';
$post_parent = '';
//edit categories
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	$edit_id = (int)$_GET['edit'];
	$edit_id = sanitize($edit_id);
	$esql="SELECT * FROM categories WHERE id='$edit_id'";
	$edit_result = $db->query($esql);
	$edit_category = mysqli_fetch_assoc($edit_result);

}
//Delete categories
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$delete_id = (int)$_GET['delete'];
	$delete_id = sanitize($delete_id);
	$sql = "SELECT * FROM categories WHERE id = '$delete_id'";
	$result = $db->query($sql);
	$category = mysqli_fetch_assoc($result);
	if ($category['parent']==0) {
		$sql="DELETE FROM  categories WHERE parent='$delete_id'";
	$db->query($sql);
	}

	$dsql="DELETE FROM  categories WHERE id='$delete_id'";
	$db->query($dsql);
	header('Location: categories.php');


}
// process form
if (isset($_POST) && !empty($_POST)) {
	$post_parent = sanitize($_POST['parent']);
	$category = sanitize($_POST['category']);
	$sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent'";
	if (isset($_GET['edit'])) {
		$id = $edit_category['id'];
		$sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent' AND id !='$id'";
	}
	$fresult = $db->query($sqlform);
	$count = mysqli_num_rows($fresult);
	# check if category is blank
	if ($category =='') {
		$errors[] .= 'the category can not left blank';
	}
	#if exist in the data base
	if ($count>0) {
		$errors[] .= $category. ' already exist! Plese choose another';
	}
	//display errors or update data base
	if (!empty($errors)) {
		$display = display_errors($errors);?>
		<script>
		jQuery('document').ready(function() {
			jQuery('#errors').html('<?=$display; ?>');
		});

		</script>
	<?php } else{
			$updatesql = "INSERT INTO categories (category, parent) VALUES ('$category','$post_parent')";
			if (isset($_GET['edit'])) {
				$updatesql = "UPDATE categories SET category='$category', parent='$post_parent' WHERE id = '$edit_id'";
			}
			$db->query($updatesql);
			header('Location: categories.php');


	}
}
$category_valeu = '';
$parent_Valeu = 0;
if(isset($_GET['edit'])){
	$category_valeu = $edit_category['category'];
	$parent_Valeu = $edit_category['parent'];

}else{

	if (isset($_POST)) {
		$category_valeu=$category;
		$parent_Valeu = $post_parent;

	}
}
?>
<div class="container-fluid">
<h2 class="text-center">Categories</h2>
<div class="container">
  <div class="row">
    <div class="col-md-6">
     <form action="categories.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
     	<legend><?=((isset($_GET['edit'])))?'Edit':'Add A';?> Category</legend>
     	<div id="errors"></div>
		  <div class="form-group">
		    <label for="parent">Parent</label>
		    <select class="form-control" name="parent" id="parent">
		    <option value="0" <?=(($parent_Valeu == 0)?'  selected="selected"':'')?>>parent</option>
		    <?php while ($parent = mysqli_fetch_assoc($result)): ?>
		    	<option value="<?=$parent['id'];?>"<?=(($parent_Valeu ==$parent['id']))?' selected="selected"':'' ;?>><?=$parent['category']; ?></option>
		    <?php endwhile; ?>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="category">Category</label>
		    <input type="text" class="form-control" id="category" name="category" value="<?=$category_valeu;?>">
		  </div>
		  <div class="form-group">
		  	<input type="submit" class="btn-success" value="<?=((isset($_GET['edit'])))?'Edit':'Add A';?> Category">
		  </div>
</form>
    </div>
    <!-- category table-->
    <div class="col-md-6">
     <table class="table table-auto">
  <thead class="thead-dark">
  	<th>Category</th>
  	<th>Parent</th>
  	<th>Actions</th>
  </thead>
  <tbody>
  	<?php 
  	$sql="SELECT * FROM categories WHERE parent = 0";
$result = $db->query($sql);
  	while($parent = mysqli_fetch_assoc($result)): 
  		$parent_id = (int)$parent['id'];
  		$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
  		$cresult = $db->query($sql2);
  		?>
  	<tr class="table-primary">
  		<td><?=$parent['category']; ?></td>
  		<td>parent</td>
  		<td><a href="categories.php?edit=<?=$parent['id']; ?>" class="btn btn-xs btn-default"><i class="fas fa-edit"></i></a>
  			<a href="categories.php?delete=<?=$parent['id']; ?>" class="btn btn-xs btn-default"><i class="fas fa-trash-alt"></i></a></td>
  		
  		
  	</tr>
  	<?php while($child = mysqli_fetch_assoc($cresult)): ?>
  	  	<tr class="table-info">
  		<td><?=$child['category']; ?></td>
  		<td><?=$parent['category']; ?></td>
  		<td><a href="categories.php?edit=<?=$child['id']; ?>" class="btn btn-xs btn-default"><i class="fas fa-edit"></i></a>
  			<a href="categories.php?delete=<?=$child['id']; ?>" class="btn btn-xs btn-default"><i class="fas fa-trash-alt"></i></a></td>
  		
  		
  	</tr>
  	<?php endwhile; ?>
  <?php endwhile; ?>
  </tbody>
</table>
    </div>
  </div>
</div>
</div>


<?php include 'includes/footer.php'; ?>