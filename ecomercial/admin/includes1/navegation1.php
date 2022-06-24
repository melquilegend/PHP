 <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">Ecomercias | Admin</h5>
      <nav class="my-2 my-md-0 mr-md-3">
      	
        <a class="p-2 text-dark" href="index.php">Home</a>
        <a class="p-2 text-dark" href="categories.php">Categories</a>
        <a class="p-2 text-dark" href="brand.php">Brand</a>
        <a class="p-2 text-dark" href="products.php">Products</a>
        <a class="p-2 text-dark" href="products_restoure.php">Deleted Producs</a>
        <?php if (has_permission('admin')):?>
        <a class="p-2 text-dark" href="users.php">Users</a>
      <?php endif;?>
      </nav>
      <a class="btn btn-outline-primary" href="logout.php">Logout</a>
    </div>