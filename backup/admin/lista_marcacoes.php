<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php';
if (!is_logged_in()) {
  login_error_ridirect();
}
if (isset($_GET['delete'])) {
  $delete_id = sanitize($_GET['delete']);
  $db->query("DELETE FROM consulta WHERE consultaid = '$delete_id'");
  $_SESSION['success_flash'] = "Consulta apagada com sucesso";
  header("Location:lista_marcacoes.php");
}
?>
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
                        <h2 class="text-black font-w600">Consultas </h2>
                        <p class="mb-0">Consultas Marcadas</p>
                    </div>
                </div>

                <!--**********************************
                todo conteudo aqui
                ***********************************-->

                <?php
               $idconsultaid=$user_data['id'];
  $sql = "SELECT consulta.consultaid, consulta.n_consulta, tipo_consulta.id, tipo_consulta.nome, consulta.doctor_id, consulta.hora_consulta, patient.full_name, patient.address, patient.cellphone, patient.email, consulta.tipo_consultaid, consulta.motivo_consulta, consulta.sintomas, consulta.data_consulta, consulta.status, consulta.visita_clinica, consulta.comentario_doctor FROM consulta LEFT JOIN doctores ON consulta.doctor_id= doctores.id LEFT JOIN patient ON consulta.patient_id=patient.id LEFT JOIN tipo_consulta on consulta.tipo_consultaid = tipo_consulta.id";
  $uresults = $db->query($sql);
  $statement = "SELECT id,nome FROM tipo_consulta";
  $dt = $db->query($statement);
if (isset($_GET['add']) || isset($_GET['edit']) ) {
  $permitionsQuery=$db->query("SELECT * FROM consulta ORDER BY n_consulta");
$doctor_id = ((isset( $_POST['doctor_id']) && $_POST['doctor_id'] != '')?sanitize($_POST['doctor_id']):'');
$patient_id=((isset( $_POST['patient_id']) &&  !empty($_POST['patient_id']))?sanitize($_POST['patient_id']):'');
$agenda_medica_id=((isset( $_POST['agenda_medica_id']) &&  !empty($_POST['agenda_medica_id']))?sanitize($_POST['agenda_medica_id']):'');
$n_consulta=((isset( $_POST['n_consulta']) &&  !empty($_POST['n_consulta']))?sanitize($_POST['n_consulta']):'');
$tipo_consultaid = ((isset( $_POST['tipo_consultaid']) && $_POST['tipo_consultaid'] != '')?sanitize($_POST['tipo_consultaid']):'');
$motivo_consulta=((isset( $_POST['motivo_consulta']) &&  !empty($_POST['motivo_consulta']))?sanitize($_POST['motivo_consulta']):'');
$sintomas=((isset( $_POST['sintomas']) &&  !empty($_POST['sintomas']))?sanitize($_POST['sintomas']):'');
$data_consulta=((isset( $_POST['data_consulta']) &&  !empty($_POST['data_consulta']))?sanitize($_POST['data_consulta']):'');
$hora_consulta=((isset( $_POST['hora_consulta']) &&  !empty($_POST['hora_consulta']))?sanitize($_POST['hora_consulta']):'');
$status=((isset( $_POST['status']) &&  !empty($_POST['status']))?sanitize($_POST['status']):'');
$visita_clinica = ((isset( $_POST['visita_clinica']) && $_POST['visita_clinica'] != '')?sanitize($_POST['visita_clinica']):'');
$comentario_doctor = ((isset( $_POST['comentario_doctor']) && $_POST['comentario_doctor'] != '')?sanitize($_POST['comentario_doctor']):'');
$errors= array();
if (isset($_GET['edit'])) {
   $edit_id = (int)$_GET['edit'];
   $usersresults = $db->query("SELECT * FROM consulta WHERE consultaid = '$edit_id'");
   $usersquery = mysqli_fetch_assoc($usersresults);


   $doctor_id = ((isset( $_POST['doctor_id']) && $_POST['doctor_id'] != '')?sanitize($_POST['doctor_id']):$usersquery['doctor_id']);
   $patient_id = ((isset( $_POST['patient_id']) && $_POST['patient_id'] != '')?sanitize($_POST['patient_id']):$usersquery['patient_id']);
   $agenda_medica_id = ((isset( $_POST['agenda_medica_id']) && $_POST['agenda_medica_id'] != '')?sanitize($_POST['agenda_medica_id']):$usersquery['agenda_medica_id']);
   $n_consulta = ((isset( $_POST['n_consulta']) && $_POST['n_consulta'] != '')?sanitize($_POST['n_consulta']):$usersquery['n_consulta']);
   $tipo_consultaid = ((isset( $_POST['tipo_consultaid']) && $_POST['tipo_consultaid'] != '')?sanitize($_POST['tipo_consultaid']):$usersquery['tipo_consultaid']);
   $motivo_consulta = ((isset( $_POST['motivo_consulta']) && $_POST['motivo_consulta'] != '')?sanitize($_POST['motivo_consulta']):$usersquery['motivo_consulta']);
   $sintomas = ((isset( $_POST['sintomas']) && $_POST['sintomas'] != '')?sanitize($_POST['sintomas']):$usersquery['sintomas']);
   $data_consulta = ((isset( $_POST['data_consulta']) && $_POST['data_consulta'] != '')?sanitize($_POST['data_consulta']):$usersquery['data_consulta']);
   $hora_consulta = ((isset( $_POST['hora_consulta']) && $_POST['hora_consulta'] != '')?sanitize($_POST['hora_consulta']):$usersquery['hora_consulta']);
  $status = ((isset( $_POST['status']) && $_POST['status'] != '')?sanitize($_POST['status']):$usersquery['status']);

   $visita_clinica = ((isset( $_POST['visita_clinica']) && $_POST['visita_clinica'] != '')?sanitize($_POST['visita_clinica']):$usersquery['visita_clinica']);
   $comentario_doctor = ((isset( $_POST['comentario_doctor']) && $_POST['comentario_doctor'] != '')?sanitize($_POST['comentario_doctor']):$usersquery['comentario_doctor']);
   



}
if ($_POST) {

 /* $emailQuery = $db->query("SELECT * FROM users WHERE email='$email'");
  $emailCount = mysqli_num_rows($emailQuery);
  if ($emailCount!=0) {
    $errors[] = "the email alread exist in the system";
    }*/


  $errors=array();
  $required=Array('n_consulta');
  foreach ($required as $fields) {
    if ($_POST[$fields] == '') {
      $errors[] = "All Fields with Astrisk are required.";
      break;}
  }

  if (!empty($errors)) {
   echo display_errors($errors);
  }else{

  
      $insertSql = "INSERT INTO consulta (`doctor_id`, `patient_id`, `agenda_medica_id`, `n_consulta`, `tipo_consultaid`,`motivo_consulta`, `sintomas`, `data_consulta`, `hora_consulta`, `status`, `visita_clinica`,`comentario_doctor`) VALUES ('$doctor_id', '$patient_id', '$agenda_medica_id', '$n_consulta','$tipo_consultaid', '$motivo_consulta', '$sintomas', '$data_consulta', '$hora_consulta', '$status','$visita_clinica', '$comentario_doctor')";
      $_SESSION['success_flash'] = "Consulta marcada com sucesso";
      
   if (isset($_GET['edit'])){
         $insertSql = "UPDATE consulta SET `doctor_id`='$doctor_id', `patient_id` ='$patient_id', `agenda_medica_id` ='$agenda_medica_id', `n_consulta` ='$n_consulta',  `tipo_consultaid` ='$tipo_consultaid', `motivo_consulta` ='$motivo_consulta', `sintomas` ='$sintomas', `data_consulta` ='$data_consulta', `hora_consulta`='$hora_consulta', `status`='$status', `visita_clinica`='$visita_clinica', `comentario_doctor`='$comentario_doctor' WHERE consultaid='$edit_id'";
         $_SESSION['success_flash'] = "Consulta atualizado com sucesso";
   }
   //var_dump($insertSql); 
     $db -> query($insertSql);
echo "<script>alert('Salvo'); window.location = './lista_marcacoes.php';</script>";
  }
}

  ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?=((isset( $_GET['edit']))?'Editar':'Marcar');?>  Consulta</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="lista_marcacoes.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1')?>" method="POST">
                                    <form>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <?php if (isset( $_GET['edit'])) {?>
                                                <input type="hidden" name="patient_id" value="<?=$patient_id;?>">
                                                <input type="hidden" name="agenda_medica_id" value="<?=$agenda_medica_id;?>">
                                                <input type="hidden" name="n_consulta" value="<?=$n_consulta?>">
                                                
                                                <?php } else {?>
                                                <input type="hidden" name="patient_id" value="<?=$idconsultaid;?>">
                                                <input type="hidden" name="agenda_medica_id" value="1">
                                                <?php $consultaid= uniqid('PT_2022');?>
                                                <input type="hidden" name="n_consulta" value="<?=$consultaid?>">
                                                <?php } ?>
                                                
                                                
                                                 <?php if (isset( $_GET['edit'])) {?>
                                                <input type="hidden" class="form-control" name="tipo_consultaid" value="<?=$tipo_consultaid?>" disabled>
                                                <?php } else {?>
                                                <label>Tipo de Consulta</label>
                                                <select class="form-control default-select" onchange="mudar()" id="tipo_consulta" name="tipo_consultaid">
                                                    <option value="">selecione o tipo de Consulta</option>
                                                    <?php while ($row= mysqli_fetch_array($dt)) { ?>
                                                  <option value="<?php echo $row['id']; ?>"><?=$row['nome'];?></option>
                                                  <?php } ?>
                                                </select>
                                               <?php }?>
                                            </div>
                                            
                                            <div class="form-group col-md-6" id="medico">
                                                <?php if (isset( $_GET['edit'])) {?>
                                                <input type="hidden" name="doctor_id" class="form-control" value="<?=$doctor_id?>" disabled>
                                                <?php } else {?>
                                                <label>Medico</label>
                                                <select class="form-control default-select" id="medico" name="doctor_id">
                                                    <option value="">Selecione o medico</option>
                                                </select>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Razão da Consulta</label>
                                                <div class="input-group   input-danger">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Motivo da Consulta</span>
                                                    </div>
                                                     <textarea class="form-control" name="motivo_consulta" disabled><?=$motivo_consulta?></textarea>
                                                </div>
                                            </div>
                                             <div class="form-group col-md-6">
                                                <label>Explica o que sente</label>
                                                <div class="input-group   input-danger">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Sintomas</span>
                                                    </div>
                                                     <textarea class="form-control" name="sintomas" disabled><?=$sintomas?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label>data</label>
                                                <input type="date" name="data_consulta" class="form-control" id="data_consulta" value="<?=$data_consulta?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Hora</label>
                                                <input type="time" name="hora_consulta" class="form-control" id="hora_consulta" value="<?=$hora_consulta?>" required >
                                            </div>
                                            <?php if (isset( $_GET['edit'])) {?>
                                            <div class="form-group col-md-6">
                                                <label>Status da consulta</label>
                                                <select class="form-control default-select" id="status" name="status">
                                                   
                                                     <option value="Pendente">Pendente</option>
                                                     <option value="Marcada">Marcada</option>
                                                     <option value="Efetuada">Efetuada</option>

                                                </select>
                                                <strong><input type="text" name="status" class="form-control" id="status" value="<?=$status?>" disabled></strong>
                                            </div>
                                            <?php } else {?>

                                            <?php } ?>
                                            <div class="form-group col-md-6">
                                                <label>Visitar a clinica</label>
                                                <select class="form-control default-select" id="visita_clinica" name="visita_clinica">
                                                    <option value=""<?=(($visita_clinica== '' )?' selected':'');?>></option>
                                                     <option value="0"<?=(($visita_clinica== '0' )?' selected':'');?>>Não</option>
                                                     <option value="1"<?=(($visita_clinica== '1' )?' selected':'');?>>Sim</option>

                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Observação Medica</label>
                                                <div class="input-group   input-danger">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Observação</span>
                                                    </div>
                                                     <textarea class="form-control" name="comentario_doctor"><?=$comentario_doctor?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 mx-auto ">
                                          
                                        <button type="submit" class="btn btn-primary mr-3"><?=((isset( $_GET['edit']))?'Editar ':'Adicionar ');?> Consulta</button>
                                        </div>
                                        <a href="configuracao.php" class="btn btn-primary mr-3"> Voltar</a>
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
                                        <th>Consulta Nº</th>
                                        <th>Nome do Paciente </th>
                                        <th>Medico</th>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>Estado</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php while ($consulta= mysqli_fetch_assoc($uresults)):?>
                

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
                                        <td><span class="text-nowrap"><?=$consulta['n_consulta'];?></span></td>
                                        <td><?=$consulta['full_name'];?></td>
                                        
                                        <td><?=$consulta['doctor_id']?></td>
                                        <td><?=formatdate($consulta['data_consulta']);?></td>
                                        <td><?=$consulta['hora_consulta']?></td>
                                        <td>
                                            <a href="javascript:void(0)" class="<?=(( $consulta['status'] == 'Marcada')?'btn btn-primary text-nowrap btn-sm light':'btn btn-warning ext-nowrap btn-sm light');?>"><?=$consulta['status']?></a>
                                        </td>
                                        
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
                                                    <a class="dropdown-item" href="ver_consulta.php?details=<?=$consulta['consultaid'];?>">Ver Detalhes</a>
                                                    <a class="dropdown-item" href="lista_marcacoes.php?edit=<?=$consulta['consultaid'];?>">Editar</a>
                                                    <a class="dropdown-item" href="lista_marcacoes.php?delete=<?=$consulta['consultaid'];?>">Apagar</a> 
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
    <script type="text/javascript">
       function mudar(){
                var xmlhttp= new XMLHttpRequest();
                xmlhttp.open("GET", "ajax.php?tipo_consulta="+document.getElementById("tipo_consulta").value,false);
                xmlhttp.send(null);
                /* alert(xmlhttp.responseText); */
                document.getElementById("medico").innerHTML=xmlhttp.responseText;
            }
    </script>
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
    <script src="./vendor/global/global.min.js"></script>
    <script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>
        
</body>
</html>