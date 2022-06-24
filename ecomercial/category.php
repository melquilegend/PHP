<?php 
require_once 'core/int.php';
include  'includes/head.php';
include  'includes/navbar.php';
include  'includes/carrocel.php';
if (isset($_GET['cat'])) {
  $cat_id = sanitize($_GET['cat']);
}else{
  $cat_id='';
}
$sql="SELECT * FROM  products WHERE categories = '$cat_id' && deleted=0";
$productsQ=$db->query($sql);
$category = get_category($cat_id);
?>
	<!-- top nav -->

<!-- header -->

<div class="container-fluid">
  <div class="row">
    <div class="col-md-2">
      Left side
    </div>
    <div class="col-md-8">
       <h2 class="text-center"><?=$category['parent'].', '.$category['child'];?>
       </h2>
       <div class="row">
         <?php while ($product=mysqli_fetch_assoc($productsQ)):?>
         <div class="col-sm-2">
          <h7 class="text-center"><?php echo $product['title'];?></h7>
          <img src="<?php echo $product['image'];?>" width="120" height="200" alt="<?php echo $product['title'];?>">
          <p class="list-price text-danger">List Price: <s>N$<?php echo $product['list_prices'];?></s></p>
          <p class="price">Now: N$<?php echo $product['price'];?></p>
          <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?php echo $product['id'];?> )"> Details</button>
        
        </div>     
        <?php endwhile; ?>
       </div>
    </div>
    <div class="col-md-2">
      One of three columns
    </div>
  </div>
</div>
<?php 
include  'includes/footer.php';
 ?>
