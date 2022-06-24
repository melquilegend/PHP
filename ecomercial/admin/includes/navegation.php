
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="../index.php">Ecomercial</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="categories.php">Categories</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="brand.php">Brand</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="products.php">Products</a>
      </li>
        <li class="nav-item">
         <a class="nav-link" href="products_restoure.php">Deleted Producs</a>
      </li>
        <li class="nav-item">
          <?php if (has_permission('admin')):?>
        <a class="nav-link" href="users.php">Users</a>
      <?php endif;?>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Hello! <?=$user_data['first'];?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="profile.php">Profile</a>
           <a class="dropdown-item" href="change_password.php">Change Password</a>
          <a class="dropdown-item" href="logout.php">Log Out</a>
      </li>
    </ul>
  </div>
</nav>



