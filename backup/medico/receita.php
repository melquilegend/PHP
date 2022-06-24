<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php';
if (!is_logged_in_m()) {
  login_error_ridirect();
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
                        <h2 class="text-black font-w600">Receitas</h2>
                        <p class="mb-0">Receitas Medicos</p>
                    </div>
                </div>

                <!--**********************************
                todo conteudo aqui
                ***********************************-->

                <?php
$getadmin = sanitize((int)$_GET['add']);

$idconsultaid=$user_data['id'];
  $sql = "SELECT receita_medica.receita_id, receita_medica.relatorio_id, receita_medica.num_receita, receita_medica.descricao, receita_medica.comentario_medico, relatorio_consulta.relatorio_id, relatorio_consulta.consulta_id, relatorio_consulta.doctor_id, relatorio_consulta.patient_id, relatorio_consulta.num_relatorio, relatorio_consulta.descricao, relatorio_consulta.comentario_medico, patient.pacient_nomecompleto, patient.id, patient.cellphone, patient.email, doctores.full_name, doctores.especialidade, doctores.cellphone, doctores.id, consulta.data_consulta, consulta.n_consulta, consulta.consultaid, consulta.n_consulta, tipo_consulta.id, tipo_consulta.nome FROM receita_medica LEFT JOIN relatorio_consulta ON receita_medica.relatorio_id = relatorio_consulta.relatorio_id   LEFT JOIN doctores ON relatorio_consulta.doctor_id = doctores.id LEFT JOIN patient ON relatorio_consulta.patient_id = patient.id LEFT JOIN consulta ON relatorio_consulta.consulta_id = consulta.consultaid LEFT JOIN tipo_consulta on consulta.tipo_consultaid = tipo_consulta.id WHERE relatorio_consulta.doctor_id =  '$idconsultaid'";
  $uresults = $db->query($sql);
$admins_details="SELECT consulta.consultaid, consulta.n_consulta, relatorio_consulta.consulta_id, relatorio_consulta.relatorio_id, tipo_consulta.id, tipo_consulta.nome, consulta.doctor_id, consulta.hora_consulta, consulta.patient_id, patient.pacient_nomecompleto, patient.address, patient.cellphone, patient.email, consulta.tipo_consultaid, consulta.motivo_consulta, consulta.sintomas, consulta.data_consulta, consulta.status, consulta.visita_clinica, consulta.comentario_doctor FROM consulta LEFT JOIN relatorio_consulta ON relatorio_consulta.consulta_id=consulta.consultaid LEFT JOIN doctores ON consulta.doctor_id= doctores.id LEFT JOIN patient ON consulta.patient_id=patient.id LEFT JOIN tipo_consulta on consulta.tipo_consultaid = tipo_consulta.id WHERE consulta.consultaid =     '{$getadmin}'";
$datas=$db->query($admins_details);
$data = mysqli_fetch_assoc($datas);
  $statement = "SELECT id,nome FROM tipo_consulta";
  $dt = $db->query($statement);
if (isset($_GET['add']) || isset($_GET['edit']) ) {
  $permitionsQuery=$db->query("SELECT * FROM relatorio_consulta ORDER BY num_relatorio");
$doctor_id = ((isset( $_POST['doctor_id']) && $_POST['doctor_id'] != '')?sanitize($_POST['doctor_id']):'');
$patient_id=((isset( $_POST['patient_id']) &&  !empty($_POST['patient_id']))?sanitize($_POST['patient_id']):'');
$consulta_id=((isset( $_POST['consulta_id']) &&  !empty($_POST['consulta_id']))?sanitize($_POST['consulta_id']):'');
$relatorio_id=((isset( $_POST['relatorio_id']) &&  !empty($_POST['relatorio_id']))?sanitize($_POST['relatorio_id']):'');
$num_receita=((isset( $_POST['num_receita']) &&  !empty($_POST['num_receita']))?sanitize($_POST['num_receita']):'');
$descricao = ((isset( $_POST['descricao']) && $_POST['descricao'] != '')?sanitize($_POST['descricao']):'');
$comentario_medico=((isset( $_POST['comentario_medico']) &&  !empty($_POST['comentario_medico']))?sanitize($_POST['comentario_medico']):'');
$errors= array();
if (isset($_GET['edit'])) {
   $edit_id = (int)$_GET['edit'];
   $usersresults = $db->query("SELECT * FROM relatorio_consulta WHERE relatorio_id = '$edit_id'");
   $usersquery = mysqli_fetch_assoc($usersresults);


   $doctor_id = ((isset( $_POST['doctor_id']) && $_POST['doctor_id'] != '')?sanitize($_POST['doctor_id']):$usersquery['doctor_id']);
   $patient_id = ((isset( $_POST['patient_id']) && $_POST['patient_id'] != '')?sanitize($_POST['patient_id']):$usersquery['patient_id']);
   $consulta_id = ((isset( $_POST['consulta_id']) && $_POST['consulta_id'] != '')?sanitize($_POST['consulta_id']):$usersquery['consulta_id']);
   $num_receita = ((isset( $_POST['num_receita']) && $_POST['num_receita'] != '')?sanitize($_POST['num_receita']):$usersquery['num_receita']);
   $descricao = ((isset( $_POST['descricao']) && $_POST['descricao'] != '')?sanitize($_POST['descricao']):$usersquery['descricao']);
   $comentario_medico = ((isset( $_POST['comentario_medico']) && $_POST['comentario_medico'] != '')?sanitize($_POST['comentario_medico']):$usersquery['comentario_medico']);

}
if ($_POST) {

 /* $emailQuery = $db->query("SELECT * FROM users WHERE email='$email'");
  $emailCount = mysqli_num_rows($emailQuery);
  if ($emailCount!=0) {
    $errors[] = "the email alread exist in the system";
    }*/


  $errors=array();
  $required=Array('descricao');
  foreach ($required as $fields) {
    if ($_POST[$fields] == '') {
      $errors[] = "Todos os campos com asterisco são obrigatórios.";
      break;}
  }

  if (!empty($errors)) {
   echo display_errors($errors);
  }else{

  
      $insertSql = "INSERT INTO receita_medica (`doctor_id`, `patient_id`, `consulta_id`, `relatorio_id`, `num_receita`, `descricao`,`comentario_medico`) VALUES ('$doctor_id', '$patient_id', '$consulta_id', '$relatorio_id', '$num_receita', '$descricao', '$comentario_medico')";
      $_SESSION['success_flash'] = "Consulta marcada com sucesso";
      
   if (isset($_GET['edit'])){
         $insertSql = "UPDATE receita_medica SET `doctor_id`='$doctor_id', `patient_id` ='$patient_id', `consulta_id` ='$consulta_id', `relatorio_id` ='$relatorio_id', `num_receita` ='$num_receita',  `descricao` ='$descricao', `comentario_medico` ='$comentario_medico'";
         $_SESSION['success_flash'] = "Consulta atualizado com sucesso";
   }
   //var_dump($insertSql); 
     $db -> query($insertSql);
echo "<script>alert('Salvo'); window.location = './receita.php';</script>";
  }
}

  ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?=((isset( $_GET['edit']))?'Editar':'Criar');?>  Relatorio </h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="receita.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1')?>" method="POST">
                                    <form>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <?php $idpatient = $data['patient_id']?>
                                                <input type="hidden" name="patient_id" value="<?=$idpatient;?>">
                                                <?php $iddoctor = $data['doctor_id']?>
                                                <input type="hidden" name="doctor_id" value="<?=$iddoctor;?>">
                                                <?php $idconsulta = $data['consultaid']?>
                                                <input type="hidden" name="consulta_id" value="<?=$idconsulta;?>">
                                                <?php $relatorioid= uniqid('RC_2022');?>
                                                <input type="hidden" name="num_receita" value="<?=$relatorioid?>">
                                                 <?php $idrelatorio= $data['relatorio_id'];?>
                                                <input type="hidden" name="relatorio_id" value="<?=$idrelatorio?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Nome do Paciente</label>
                                                <?php $nome_paciente = $data['pacient_nomecompleto']?>
                                                <input type="text" name="data_consulta" class="form-control" id="data_consulta" value="<?=$nome_paciente;?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Receita</label>
                                                <textarea class="form-control" name="descricao"></textarea>
                                            </div>
                                            
                                             <div class="form-group col-md-6">
                                                <label>Observação Medica</label>
                                                <textarea class="form-control" name="comentario_medico"></textarea>
                                            </div>
                                           
                                        </div>
                                        <div class="form-group col-md-3 mx-auto ">
                                          
                                        <button type="submit" class="btn btn-primary mr-3"><?=((isset( $_GET['edit']))?'Editar ':'Adicionar ');?> Consulta</button>
                                        </div>
                                        <a href="lista_marcacoes.php" class="btn btn-primary mr-3"> Voltar</a>
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
                                        <th>Consulta Nº </th>
                                        <th>Nome do Paciente </th>
                                        <th>Tipo de consulta</th>
                                        <th>Data</th>
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
                                        <td><?=$consulta['pacient_nomecompleto'];?></td>
                                        
                                        <td><?=$consulta['nome']?></td>
                                        <td><?=formatdate($consulta['data_consulta']);?></td>
                                        
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
                                                    <a class="dropdown-item" href="ver_receita.php?details=<?=$consulta['receita_id'];?>">Ver Detalhes</a>
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