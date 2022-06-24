<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php';
if (!is_logged_in()) {
  login_error_ridirect();
}
if (!has_permission('admin')) {
  permission_error_redirect('index.php');
}
if (isset($_GET['delete'])) {
  $delete_id = sanitize($_GET['delete']);
  $db->query("DELETE FROM users WHERE id = '$delete_id'");
  $_SESSION['success_flash'] = "O usuário foi excluído com sucesso";
  header("Location:admin_user.php");
}
?>

<?php include 'includes/head.php';
?>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="./images/logo.png" alt="">
                <img class="logo-compact" src="./images/logo-text.png" alt="">
                <img class="brand-title" src="./images/logo-text.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

      
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
<div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
								<div class="input-group search-area d-lg-inline-flex d-none">
									<input type="text" class="form-control" placeholder="Search here...">
									<div class="input-group-append">
										<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
									</div>
								</div>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
									<div class="header-info">
										<span class="text-black">Hello, <strong><?=$user_data['full_name'];?></strong></span>
										<p class="fs-12 mb-0"><?=$user_data['permissions'];?></p>
									</div> 
                                    <img src="images/profile/17.jpg" width="20" alt=""/>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="logout.php" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include 'includes/siidebar_start.php';?>
?>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
          <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-sm-4 mb-3">
					<div class="mr-auto">
						<h2 class="text-black font-w600">Adiministradores</h2>
						<p class="mb-0">Lista de administradores do sistema</p>
					</div>
					<div>
						<a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+New Patient</a>
						<a href="index.html" class="btn btn-outline-primary"><i class="las la-calendar-plus scale5 mr-3"></i>Filter Date</a>
					</div>
				</div>

				<!--**********************************
            	todo conteudo aqui
        		***********************************-->

        		<?php
  $sql = "SELECT * FROM users ORDER BY full_name";
  $uresults = $db->query($sql);
if (isset($_GET['add']) || isset($_GET['edit']) ) {
  $permitionsQuery=$db->query("SELECT * FROM users ORDER BY permissions");
$full_name = ((isset( $_POST['full_name']) && $_POST['full_name'] != '')?sanitize($_POST['full_name']):'');
$email=((isset( $_POST['email']) &&  !empty($_POST['email']))?sanitize($_POST['email']):'');
$password=((isset( $_POST['password']) &&  !empty($_POST['password']))?sanitize($_POST['password']):'');
$confirm=((isset( $_POST['confirm']) &&  !empty($_POST['confirm']))?sanitize($_POST['confirm']):'');
$last_login = ((isset( $_POST['last_login']) && $_POST['last_login'] != '')?sanitize($_POST['last_login']):'');
$permissions = ((isset( $_POST['permissions']) && $_POST['permissions'] != '')?sanitize($_POST['permissions']):'');
$errors= array();
if (isset($_GET['edit'])) {
   $edit_id = (int)$_GET['edit'];
   $usersresults = $db->query("SELECT * FROM users WHERE id = '$edit_id'");
   $usersquery = mysqli_fetch_assoc($usersresults);


   $full_name = ((isset( $_POST['full_name']) && $_POST['full_name'] != '')?sanitize($_POST['full_name']):$usersquery['full_name']);
   $email = ((isset( $_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$usersquery['email']);
   $password = ((isset( $_POST['password']) && $_POST['password'] != '')?sanitize($_POST['password']):$usersquery['password']);
  $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');

   $last_login = ((isset( $_POST['last_login']) && $_POST['last_login'] != '')?sanitize($_POST['last_login']):$usersquery['last_login']);
   $permissions = ((isset( $_POST['permissions']) && $_POST['permissions'] != '')?sanitize($_POST['permissions']):$usersquery['permissions']);



}
if ($_POST) {

 /* $emailQuery = $db->query("SELECT * FROM users WHERE email='$email'");
  $emailCount = mysqli_num_rows($emailQuery);
  if ($emailCount!=0) {
    $errors[] = "the email alread exist in the system";
    }*/


  $errors=array();
  $required=Array('full_name','email','password','last_login','permissions');
  foreach ($required as $fields) {
    if ($_POST[$fields] == '') {
      $errors[] = "Todos os campos com asterisco são obrigatórios.";
      break;}
  }
    if (strlen($password)<6) {
               $errors[] = "a senha deve ter pelo menos 6 caracteres";
            }
    if ($password != $confirm) {
              $errors[] = "A nova senha e a confirmação da nova senha não correspondem!";
            }
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
               $errors[] = "Você deve inserir o e-mail válido";
            }

  if (!empty($errors)) {
   echo display_errors($errors);
  }else{

    $hashed =  password_hash($password, PASSWORD_DEFAULT);
      $insertSql = "INSERT INTO users (`full_name`, `email`, `password`, `last_login`, `permissions`) VALUES ('$full_name', '$email', '$hashed', '$last_login', '$permissions')";
      $_SESSION['success_flash'] = "Usuário adicionado com sucesso";
      
   if (isset($_GET['edit'])){
         $insertSql = "UPDATE users SET `full_name`='$full_name', `email` ='$email', `password`='$hashed', `last_login`='$last_login', `permissions`='$permissions' WHERE id='$edit_id'";
         $_SESSION['success_flash'] = "Atualização do usuário com sucesso";
   }
     $db -> query($insertSql);
   echo "<script>alert('Usuário Salvo com sucesso'); window.location = './users.php';</script>";
  }
}

  ?>
  					<div class="row">
						<div class="col-12">
  							<div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Horizontal Form</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="1234 Main St">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Email">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Password</label>
                                                <input type="password" class="form-control" placeholder="Password">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>City</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>State</label>
                                                <div class="dropdown bootstrap-select form-control default-select"><select id="inputState" class="form-control default-select" tabindex="-98">
                                                    <option selected="">Choose...</option>
                                                    <option>Option 1</option>
                                                    <option>Option 2</option>
                                                    <option>Option 3</option>
                                                </select><button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="button" data-id="inputState" title="Choose..."><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Choose...</div></div> </div></button><div class="dropdown-menu " role="combobox"><div class="inner show" role="listbox" aria-expanded="false" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Zip</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">
                                                    Check me out
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Sign in</button>
                                    </form>
                                </div>
                            </div>
                        </div>
							</div>
						</div>
					</div>

					<?php  }
					else{?>
					<div class="row">
					<div class="col-12">
						<div class="table-responsive card-table">
							<table id="example5" class="display dataTablesCard table-responsive-xl">
								<thead>
									<tr>
										<th>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="checkAll" required="">
												<label class="custom-control-label" for="checkAll"></label>
											</div>
										</th>
										<th></th>
										<th>ID</th>
										<th>Date Join</th>
										<th>Doctor Name</th>
										<th>Specialist</th>
										<th>Schedule</th>
										<th>Contact</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheckBox2" required="">
												<label class="custom-control-label" for="customCheckBox2"></label>
											</div>
										</td>
										<td>
											<img src="images/users/11.png" alt="" width="43">
										</td>
										<td><span class="text-nowrap">#P-00012</span></td>
										<td>26/02/2020, 12:42 AM</td>
										<td>Dr. Samantha</td>
										<td>Dentist</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light">5 Appointment</a>
										</td>
										<td><span class="text-nowrap">+12 4124 5125</span></td>
										<td><span class="text-dark">Unavailable</span></td>
										<td>
											<div class="dropdown ml-auto text-right">
												<div class="btn-link" data-toggle="dropdown">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">View Detail</a>
													<a class="dropdown-item" href="#">Edit</a>
													<a class="dropdown-item" href="#">Delete</a>
												</div>
											</div>
										</td>												
									</tr>
									<tr>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheckBox3" required="">
												<label class="custom-control-label" for="customCheckBox3"></label>
											</div>
										</td>
										<td>
											<img src="images/users/12.png" alt="" width="43">
										</td>
										<td><span class="text-nowrap">#P-00016</span></td>
										<td>26/02/2020, 12:42 AM</td>
										<td>Dr. Cindy Anderson</td>
										<td>Physical Therapy</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light">2 Appointment</a>
										</td>
										<td><span class="text-nowrap">+12 4124 5125</span></td>
										<td><span class="text-primary">Available</span></td>
										<td>
											<div class="dropdown ml-auto text-right">
												<div class="btn-link" data-toggle="dropdown">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">View Detail</a>
													<a class="dropdown-item" href="#">Edit</a>
													<a class="dropdown-item" href="#">Delete</a>
												</div>
											</div>
										</td>												
									</tr>
									<tr>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheckBox4" required="">
												<label class="custom-control-label" for="customCheckBox4"></label>
											</div>
										</td>
										<td>
											<img src="images/users/13.png" alt="" width="43">
										</td>
										<td><span class="text-nowrap">#P-00015</span></td>
										<td>26/02/2020, 12:42 AM</td>
										<td>Dr. Olivia Jean</td>
										<td>Dentist</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-outline-dark text-nowrap btn-sm">No Schedule</a>
										</td>
										<td><span class="text-nowrap">+12 4156 6675</span></td>
										<td><span class="text-dark">Unavailable</span></td>
										<td>
											<div class="dropdown ml-auto text-right">
												<div class="btn-link" data-toggle="dropdown">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">View Detail</a>
													<a class="dropdown-item" href="#">Edit</a>
													<a class="dropdown-item" href="#">Delete</a>
												</div>
											</div>
										</td>												
									</tr>
									<tr>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheckBox5" required="">
												<label class="custom-control-label" for="customCheckBox5"></label>
											</div>
										</td>
										<td>
											<img src="images/users/14.png" alt="" width="43">
										</td>
										<td><span class="text-nowrap">#P-00014</span></td>
										<td>26/02/2020, 12:42 AM</td>
										<td>Dr. David Lee</td>
										<td>Nursing</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light">2 Appointment</a>
										</td>
										<td><span class="text-nowrap">+12 4155 7623</span></td>
										<td><span class="text-dark">Unavailable</span></td>
										<td>
											<div class="dropdown ml-auto text-right">
												<div class="btn-link" data-toggle="dropdown">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">View Detail</a>
													<a class="dropdown-item" href="#">Edit</a>
													<a class="dropdown-item" href="#">Delete</a>
												</div>
											</div>
										</td>												
									</tr>
									<tr>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheckBox21" required="">
												<label class="custom-control-label" for="customCheckBox21"></label>
											</div>
										</td>
										<td>
											<img src="images/users/15.png" alt="" width="43">
										</td>
										<td><span class="text-nowrap">#P-00013</span></td>
										<td>26/02/2020, 12:42 AM</td>
										<td>Dr. Marcus Jr</td>
										<td>Physical Therapy</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light">2 Appointment</a>
										</td>
										<td><span class="text-nowrap">+12 4124 5156</span></td>
										<td><span class="text-primary">Available</span></td>
										<td>
											<div class="dropdown ml-auto text-right">
												<div class="btn-link" data-toggle="dropdown">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">View Detail</a>
													<a class="dropdown-item" href="#">Edit</a>
													<a class="dropdown-item" href="#">Delete</a>
												</div>
											</div>
										</td>												
									</tr>
									<tr>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheckBox26" required="">
												<label class="custom-control-label" for="customCheckBox26"></label>
											</div>
										</td>
										<td>
											<img src="images/users/16.png" alt="" width="43">
										</td>
										<td><span class="text-nowrap">#P-00017</span></td>
										<td>26/02/2020, 12:42 AM</td>
										<td>Dr. Kevin Zidan</td>
										<td>Nursing</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-outline-dark text-nowrap btn-sm">No Schedule</a>
										</td>
										<td><span class="text-nowrap">+12 4122 4556</span></td>
										<td><span class="text-dark">Unavailable</span></td>
										<td>
											<div class="dropdown ml-auto text-right">
												<div class="btn-link" data-toggle="dropdown">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">Ver Detalhes</a>
													<a class="dropdown-item" href="#">Editar</a>
													<a class="dropdown-item" href="#">Apagar</a>
												</div>
											</div>
										</td>												
									</tr>
									<tr>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheckBox27" required="">
												<label class="custom-control-label" for="customCheckBox27"></label>
											</div>
										</td>
										<td>
											<img src="images/users/17.png" alt="" width="43">
										</td>
										<td><span class="text-nowrap">#P-00018</span></td>
										<td>26/02/2020, 12:42 AM</td>
										<td>Dr. Gustauv Loi</td>
										<td>Dentist</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light">2 Appointment</a>
										</td>
										<td><span class="text-nowrap">+12 2567 8654</span></td>
										<td><span class="text-primary">Available</span></td>
										<td>
											<div class="dropdown ml-auto text-right">
												<div class="btn-link" data-toggle="dropdown">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">Ver Detalhes</a>
													<a class="dropdown-item" href="#">Editar</a>
													<a class="dropdown-item" href="#">Apagar</a>
												</div>
											</div>
										</td>												
									</tr>
									<tr>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheckBox28" required="">
												<label class="custom-control-label" for="customCheckBox28"></label>
											</div>
										</td>
										<td>
											<img src="images/users/18.png" alt="" width="43">
										</td>
										<td><span class="text-nowrap">#P-00019</span></td>
										<td>26/02/2020, 12:42 AM</td>
										<td>Dr. Samantha</td>
										<td>Nursing</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-outline-dark text-nowrap btn-sm">No Schedule</a>
										</td>
										<td><span class="text-nowrap">+12 4125 6211</span></td>
										<td><span class="text-dark">Unavailable</span></td>
										<td>
											<div class="dropdown ml-auto text-right">
												<div class="btn-link" data-toggle="dropdown">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">Ver Detalhes</a>
													<a class="dropdown-item" href="#">Editar</a>
													<a class="dropdown-item" href="#">Apagar</a>
												</div>
											</div>
										</td>												
									</tr>
									<tr>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheckBox29" required="">
												<label class="custom-control-label" for="customCheckBox29"></label>
											</div>
										</td>
										<td>
											<img src="images/users/19.png" alt="" width="43">
										</td>
										<td><span class="text-nowrap">#P-00012</span></td>
										<td>26/02/2020, 12:42 AM</td>
										<td>Dr. David Lee</td>
										<td>Physical Therapy</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light">2 Appointment</a>
										</td>
										<td><span class="text-nowrap">+12 6567 1245</span></td>
										<td><span class="text-primary">Available</span></td>
										<td>
											<div class="dropdown ml-auto text-right">
												<div class="btn-link" data-toggle="dropdown">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														<path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">Ver Detalhes</a>
													<a class="dropdown-item" href="#">Editar</a>
													<a class="dropdown-item" href="#">Apagar</a>
												</div>
											</div>
										</td>												
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!--**********************************
            	fim de todo conteudo 
        		***********************************-->

				</div>
        	</div>
        	<?php }?>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Todos os direitos reservados © Clínica Arco-íris   &amp; desevolvido por <a href="#" target="_blank">Gilgrácio Francisco & Nuno Raphael </a> 2022</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="./vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="./js/custom.min.js"></script>
	<script src="./js/deznav-init.js"></script>

    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script>
		(function($) {
			var table = $('#example5').DataTable({
				searching: false,
				paging:true,
				select: false,
				//info: false,         
				lengthChange:false 
				
			});
			$('#example tbody').on('click', 'tr', function () {
				var data = table.row( this ).data();
				
			});
		})(jQuery);
	</script>
</body>
</html>