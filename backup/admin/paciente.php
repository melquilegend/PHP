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
  $db->query("DELETE FROM patient WHERE id = '$delete_id'");
  $_SESSION['success_flash'] = "Paciente apagado com sucesso";
  header("Location:paciente.php");
}
?>

<?php include 'includes/head.php';?>
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
            <a href="index.php" class="brand-logo">
                <img class="logo-abbr" src="" alt="">
                <img class="logo-compact" src="" alt="">
                <img class="brand-title" src="" alt="">
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
<?php include 'includes/header.php';?>
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
                        <h2 class="text-black font-w600">Pacientes </h2>
                        <p class="mb-0">Lista de Pacientes da clinica</p>
                    </div>
                </div>

                <!--**********************************
                todo conteudo aqui
                ***********************************-->

                <?php
  $sql = "SELECT * FROM patient WHERE permissions = 'paciente' ORDER BY full_name";
  $uresults = $db->query($sql);
if (isset($_GET['add']) || isset($_GET['edit']) ) {
  $permitionsQuery=$db->query("SELECT * FROM patient ORDER BY permissions");
$full_name = ((isset( $_POST['full_name']) && $_POST['full_name'] != '')?sanitize($_POST['full_name']):'');
$email=((isset( $_POST['email']) &&  !empty($_POST['email']))?sanitize($_POST['email']):'');
$address=((isset( $_POST['address']) &&  !empty($_POST['address']))?sanitize($_POST['address']):'');
$cellphone=((isset( $_POST['cellphone']) &&  !empty($_POST['cellphone']))?sanitize($_POST['cellphone']):'');
$about=((isset( $_POST['about']) &&  !empty($_POST['about']))?sanitize($_POST['about']):'');
$password=((isset( $_POST['password']) &&  !empty($_POST['password']))?sanitize($_POST['password']):'');
$confirm=((isset( $_POST['confirm']) &&  !empty($_POST['confirm']))?sanitize($_POST['confirm']):'');
$last_login = ((isset( $_POST['last_login']) && $_POST['last_login'] != '')?sanitize($_POST['last_login']):'');
$permissions = ((isset( $_POST['permissions']) && $_POST['permissions'] != '')?sanitize($_POST['permissions']):'');
$errors= array();
if (isset($_GET['edit'])) {
   $edit_id = (int)$_GET['edit'];
   $usersresults = $db->query("SELECT * FROM patient WHERE id = '$edit_id'");
   $usersquery = mysqli_fetch_assoc($usersresults);


   $full_name = ((isset( $_POST['full_name']) && $_POST['full_name'] != '')?sanitize($_POST['full_name']):$usersquery['full_name']);
   $email = ((isset( $_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$usersquery['email']);
   $address = ((isset( $_POST['address']) && $_POST['address'] != '')?sanitize($_POST['address']):$usersquery['address']);
   $cellphone = ((isset( $_POST['cellphone']) && $_POST['cellphone'] != '')?sanitize($_POST['cellphone']):$usersquery['cellphone']);
   $about = ((isset( $_POST['about']) && $_POST['about'] != '')?sanitize($_POST['about']):$usersquery['about']);
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
  $required=Array('full_name','email','password','permissions');
  foreach ($required as $fields) {
    if ($_POST[$fields] == '') {
      $errors[] = "All Fields with Astrisk are required.";
      break;}
  }
    if (strlen($password)<6) {
               $errors[] = "password must to be at lest 6";
            }
    if ($password != $confirm) {
              $errors[] = "The new password and confirm new password does not match!";
            }
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
               $errors[] = "You must enter the valid email";
            }

  if (!empty($errors)) {
   echo display_errors($errors);
  }else{

    $hashed =  password_hash($password, PASSWORD_DEFAULT);
      $insertSql = "INSERT INTO patient (`full_name`, `email`, `address`, `cellphone`, `about`, `password`, `permissions`) VALUES ('$full_name', '$email', '$address', '$cellphone', '$about',  '$hashed', '$permissions')";
      $_SESSION['success_flash'] = "Usuario adicionado com sucesso";
      
   if (isset($_GET['edit'])){
         $insertSql = "UPDATE patient SET `full_name`='$full_name', `email` ='$email', `address` ='$address', `cellphone` ='$cellphone', `about` ='$about', `password`='$hashed', `last_login`='$last_login', `permissions`='$permissions' WHERE id='$edit_id'";
         $_SESSION['success_flash'] = "Usuario atualizado com sucesso";
   }
   
     $db -> query($insertSql);
echo "<script>alert('Salvo'); window.location = './paciente.php';</script>";
  }
}

  ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?=((isset( $_GET['edit']))?'Editar':'Adicionar Novo');?>  Utilizador</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="paciente.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1')?>" method="POST">
                                    <form>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Nome Completo</label>
                                                <input type="text" name="full_name" class="form-control" id="full_name" value="<?=$full_name?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" id="email" value="<?=$email?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Senha</label>
                                                <input type="password" name="password" class="form-control" id="password" value="<?=$password?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Confirmar senha</label>
                                                <input type="password" name="confirm" class="form-control" id="confirm" value="<?=$confirm?>" required>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label>Telefone</label>
                                                <input type="text" name="cellphone" class="form-control" id="cellphone" value="<?=$cellphone?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Sobre</label>
                                                <div class="input-group   input-danger">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Sobre Você</span>
                                                    </div>
                                                     <textarea class="form-control" name="about"><?=$about?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Nivel de utilizador</label>
                                                <select class="form-control default-select" id="permissions" name="permissions">
                                                     <option value="admin,editor"<?=(($permissions== 'admin,editor' )?' selected':'');?>>Admin</option>
                                                     <option value="paciente"<?=(($permissions== 'paciente' )?' selected':'');?>>Paciente</option>

                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Endereço</label>
                                                <input type="text" name="address" class="form-control" id="address" value="<?=$address?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mx-auto ">
                                          
                                        <button type="submit" class="btn btn-primary mr-3"><?=((isset( $_GET['edit']))?'Editar ':'Adicionar ');?> Usuario</button>
                                        </div>
                                        <a href="paciente.php" class="btn btn-primary mr-3"> Voltar</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>

                    <?php  }
                    else{?>
                    <div class="form-head d-flex mb-sm-4 mb-3">
                    <div class="mr-auto">
                    </div>
                    <div>
                        <a href="paciente.php?add=1" class="btn btn-primary mr-3" id="add-product-btn">adicionar novo Usuario</a>
                    </div>
                </div>
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
                                        <th>Data de registro</th>
                                        <th>Nome completo</th>
                                        <th>Permição</th>
                                        <th>Email</th>
                                        <th>Ultimo login</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php while ($user= mysqli_fetch_assoc($uresults)):?>
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
                                        <td><span class="text-nowrap"><?=$user['id'];?></span></td>
                                        <td><?=formatdate($user['join_date']);?></td>
                                        <td><?=$user['full_name'];?></td>
                                        <td><?=$user['permissions']?></td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light"><?=$user['email']?></a>
                                        </td>
                                        <td><span class="text-nowrap"><?=(($user['last_login']== '2018-08-01 00:00:00' )?'Never':formatdate($user['last_login']));?></span></td>
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
                                                    <a class="dropdown-item" href="paciente_details.php?details=<?=$user['id'];?>">Ver Detalhes</a>
                                                    <a class="dropdown-item" href="paciente.php?edit=<?=$user['id'];?>">Editar</a>
                                                    <a class="dropdown-item" href="paciente.php?delete=<?=$user['id'];?>">Apagar</a>
                                                    
                                                </div>
                                            </div>
                                        </td>                                               
                                    </tr>
                                <?php endwhile;?>
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