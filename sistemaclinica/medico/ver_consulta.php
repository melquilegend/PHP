<?php error_reporting(0);?><?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php';
if (!is_logged_in_m()) {
  login_error_ridirect();
}

if (isset($_GET['delete'])) {
  $delete_id = sanitize($_GET['delete']);
  $db->query("DELETE FROM users WHERE id = '$delete_id'");
  $_SESSION['success_flash'] = "O usuário foi excluído com sucesso";
  header("Location:admin_user.php");
}
$getadmin = sanitize((int)$_GET['details']);
$admins_details="SELECT consulta.consultaid, consulta.n_consulta, tipo_consulta.id, tipo_consulta.nome, consulta.doctor_id, consulta.hora_consulta, patient.full_name, patient.address, patient.cellphone, patient.email, consulta.tipo_consultaid, consulta.motivo_consulta, consulta.sintomas, consulta.data_consulta, consulta.status, consulta.visita_clinica, consulta.comentario_doctor FROM consulta LEFT JOIN doctores ON consulta.doctor_id= doctores.id LEFT JOIN patient ON consulta.patient_id=patient.id LEFT JOIN tipo_consulta on consulta.tipo_consultaid = tipo_consulta.id WHERE consulta.consultaid = '{$getadmin}'";
$datas=$db->query($admins_details);
$data = mysqli_fetch_assoc($datas);
?>
<?php include 'includes/head.php';
?>

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
				<div class="form-head page-titles d-flex align-items-center mb-sm-4 mb-3">
					<div class="mr-auto">
						<h2 class="text-black font-w600">Detalhes da consulta</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item active"><a href="javascript:void(0)"><?=$data['status']?></a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">Consulta nº: <strong><?=$data['n_consulta']?></strong></a></li>
						</ol>
					</div>
				
				</div>
				<div class="row">
					<div class="col-xl-9 col-xxl-12">
						<div class="row">
							<div class="col-xl-12">
								<div class="card details-card">
									<img src="images/bg.jpg" alt="" class="bg-img">
									<div class="card-body">
										<div class="d-sm-flex mb-3">
											<div class="img-card mb-sm-0 mb-3">	
												<img src="images/profile/2.png" alt=""> 
												<div class="info d-flex align-items-center p-md-3 p-2 bg-primary">
													<svg class="mr-3 d-sm-inline-block d-none" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M28.75 12.5C28.7538 11.8116 28.568 11.1355 28.213 10.5458C27.8581 9.95597 27.3476 9.47527 26.7376 9.15632C26.1276 8.83737 25.4415 8.69248 24.7547 8.73752C24.0678 8.78257 23.4065 9.01581 22.8434 9.4117C22.2803 9.80758 21.837 10.3508 21.5621 10.9819C21.2872 11.613 21.1913 12.3076 21.2849 12.9896C21.3785 13.6715 21.6581 14.3146 22.0929 14.8482C22.5277 15.3819 23.101 15.7855 23.75 16.015V20C23.75 21.6576 23.0915 23.2473 21.9194 24.4194C20.7473 25.5915 19.1576 26.25 17.5 26.25C15.8424 26.25 14.2527 25.5915 13.0806 24.4194C11.9085 23.2473 11.25 21.6576 11.25 20V18.65C13.3301 18.3482 15.2323 17.3083 16.6092 15.7203C17.9861 14.1322 18.746 12.1019 18.75 10V2.5C18.75 2.16848 18.6183 1.85054 18.3839 1.61612C18.1495 1.3817 17.8315 1.25 17.5 1.25H13.75C13.4185 1.25 13.1005 1.3817 12.8661 1.61612C12.6317 1.85054 12.5 2.16848 12.5 2.5C12.5 2.83152 12.6317 3.14946 12.8661 3.38388C13.1005 3.6183 13.4185 3.75 13.75 3.75H16.25V10C16.25 11.6576 15.5915 13.2473 14.4194 14.4194C13.2473 15.5915 11.6576 16.25 10 16.25C8.34239 16.25 6.75268 15.5915 5.58058 14.4194C4.40848 13.2473 3.75 11.6576 3.75 10V3.75H6.25C6.58152 3.75 6.89946 3.6183 7.13388 3.38388C7.3683 3.14946 7.5 2.83152 7.5 2.5C7.5 2.16848 7.3683 1.85054 7.13388 1.61612C6.89946 1.3817 6.58152 1.25 6.25 1.25H2.5C2.16848 1.25 1.85054 1.3817 1.61612 1.61612C1.3817 1.85054 1.25 2.16848 1.25 2.5V10C1.25402 12.1019 2.01386 14.1322 3.3908 15.7203C4.76773 17.3083 6.6699 18.3482 8.75 18.65V20C8.75 22.3206 9.67187 24.5462 11.3128 26.1872C12.9538 27.8281 15.1794 28.75 17.5 28.75C19.8206 28.75 22.0462 27.8281 23.6872 26.1872C25.3281 24.5462 26.25 22.3206 26.25 20V16.015C26.9792 15.7599 27.6114 15.2848 28.0591 14.6552C28.5069 14.0256 28.7483 13.2726 28.75 12.5Z" fill="white"/>
													</svg>
													<div>
														<p class="fs-14 text-white op5 mb-1"></p>
														<span class="fs-18 text-white"><?=$data['full_name']?></span>
													</div>
												</div>
											</div>
											<div class="card-info d-flex align-items-start">
												<div class="mr-auto pr-3">
													<h2 class="font-w600 mb-2 text-black"><?=$data['full_name']?></h2>
													
													<span class="date">
													<i class="las la-clock"></i>
													Consulta marcada em <?=formatdate($data['data_consulta']);?></span>
												</div>
												<span class="mr-ico bg-primary">
													<i class="las la-mars"></i>
												</span>
											</div>
										</div>
										<h4 class="fs-20 text-black font-w600">Sintomas</h4>
										<p>
											<?=$data['sintomas']?>
										</p>
										
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-7 mb-sm-0 mb-3">
												<div class="d-flex">
													
													<div>
														<span class="d-block mb-1">Motivo</span>
														<p class="fs-18 mb-0 text-black"><strong class="d-block"><?=$data['motivo_consulta']?></strong></p>
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="row">
									<div class="col-lg-12 col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="media align-items-center">
													
													<div class="media-body">
														<span class="d-block mb-1">Tipo de consulta</span>
														<p class="fs-18 mb-0 text-black"><?=$data['nome']?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="media align-items-center">
													
													<div class="media-body">
														<span class="d-block mb-1">Hora</span>
														<p class="fs-18 mb-0 text-black"><?=$data['hora_consulta']?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-7 mb-sm-0 mb-3">
												<div class="d-flex">
													<div>
														<span class="d-block mb-1">Observação Medica</span>
														<p class="fs-18 mb-0 text-black"><strong class="d-block"><?=$data['comentario_doctor']?></strong></p>
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="row">
									<div class="col-lg-12 col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="media align-items-center">
													<i class="las la-phone fs-30 text-primary mr-3"></i>
													<div class="media-body">
														<span class="d-block mb-1">Phone</span>
														<p class="fs-18 mb-0 text-black"><?=$data['cellphone']?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="media align-items-center">
													<i class="las la-envelope-open fs-30 text-primary mr-3"></i>
													<div class="media-body">
														<span class="d-block mb-1">Email</span>
														<p class="fs-18 mb-0 text-black"><?=$data['email']?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-7">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-7 mb-sm-0 mb-3">
												<div class="d-flex">
													<i class="las la-map-marker text-primary fs-34 mr-3"></i>
													<div>
														<span class="d-block mb-1">Endereço</span>
														<p class="fs-18 mb-0 text-black"><strong class="d-block"><?=$data['address']?></strong></p>
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
            </div>
        </div>
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
	
	<!-- Chart piety plugin files -->
    <script src="./vendor/peity/jquery.peity.min.js"></script>
	
	<!-- Apex Chart -->
	<script src="./vendor/apexchart/apexchart.js"></script>
	<!-- Dashboard 1 -->
	<script src="./js/dashboard/patient-details.js"></script>
</body>
</html>