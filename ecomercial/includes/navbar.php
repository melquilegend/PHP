<?php
$sql="SELECT * FROM categories WHERE parent=0";
$pquery=$db->query($sql);
?>
 <header>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

        <div class="container">
	<a href="index.php" class="navbar-brand">Ecomercial</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
	<ul class="navbar-nav mr-auto">
		 <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <?php while ($parent=mysqli_fetch_assoc($pquery)):?>
            <?php 
            $parent_id = $parent['id']; 
            $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
            $cquery = $db->query($sql2);
            ?>

            <!-- menu items-->
          		<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $parent['category'];?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <?php while ($child=mysqli_fetch_assoc($cquery)):?>
              <a class="dropdown-item" href="category.php?cat=<?=$child['id'];?>"><?php echo $child['category'];?></a>
            <?php endwhile; ?>
            </div>
          </li>
        <?php endwhile; ?>
        
		     <li class="nav-item">
            <a class="nav-link" href="#">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
  </ul>
  <ul class="navbar-nav ml-auto">
           <li class="nav-item">
            <a class="nav-link" href="cart.php">My cart <i class="fas fa-shopping-cart"></i></a>
          </li>
	</ul>
	
</div>
</div>
</nav>
</header>