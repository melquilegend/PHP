<?php error_reporting(0); ?><?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php';
if (!is_logged_in_m()) {
  login_error_ridirect();
}
$getadmin = sanitize((int)$_GET['details']);
$admins_details="SELECT receita_medica.receita_id, receita_medica.doctor_id, receita_medica.patient_id, receita_medica.consulta_id, receita_medica.relatorio_id, receita_medica.num_receita, receita_medica.descricao, receita_medica.comentario_medico, relatorio_consulta.relatorio_id, relatorio_consulta.consulta_id, relatorio_consulta.doctor_id, relatorio_consulta.patient_id, relatorio_consulta.num_relatorio, relatorio_consulta.resultado, patient.pacient_nomecompleto, patient.id, patient.cellphone, patient.email, doctores.full_name, doctores.especialidade, doctores.cellphone, doctores.id, consulta.data_consulta, consulta.motivo_consulta, consulta.sintomas, consulta.tipo_consultaid, tipo_consulta.id, tipo_consulta.nome, consulta.tipo_consultaid FROM receita_medica LEFT JOIN relatorio_consulta ON receita_medica.relatorio_id = relatorio_consulta.relatorio_id LEFT JOIN doctores ON relatorio_consulta.doctor_id = doctores.id LEFT JOIN patient ON relatorio_consulta.patient_id = patient.id LEFT JOIN consulta ON relatorio_consulta.consulta_id = consulta.consultaid LEFT JOIN tipo_consulta ON consulta.tipo_consultaid = tipo_consulta.id WHERE receita_id = '{$getadmin}'";
$datas=$db->query($admins_details);
$data = mysqli_fetch_assoc($datas);
$saber_consulta="SELECT relatorio_consulta.relatorio_id, relatorio_consulta.consulta_id, relatorio_consulta.doctor_id, relatorio_consulta.patient_id, relatorio_consulta.num_relatorio, relatorio_consulta.descricao, relatorio_consulta.comentario_medico, patient.pacient_nomecompleto, patient.id, patient.cellphone, patient.email, doctores.full_name, doctores.especialidade, doctores.cellphone, doctores.id, consulta.data_consulta FROM relatorio_consulta LEFT JOIN doctores ON relatorio_consulta.doctor_id = doctores.id LEFT JOIN patient ON relatorio_consulta.patient_id = patient.id LEFT JOIN consulta ON relatorio_consulta.consulta_id = consulta.consultaid WHERE relatorio_consulta.relatorio_id  = '{$getadmin}'";
$datas_name=$db->query($saber_consulta);
$nome_medico = mysqli_fetch_assoc($datas_name);
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
    integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js"
    integrity="sha256-srhz/t0GOrmVGZryG24MVDyFDYZpvUH2+dnJ8FbpGi0=" crossorigin="anonymous"></script>
<div class="wrapper">
    <div class="prescription_form">
        <table class="prescription" data-prescription_id="<?php echo $presc->prescription_id; ?>" border="1">
            <tbody>
                <tr height="15%">
                    <td colspan="2">
                        <div class="header">
                            <div class="logo">
                                <img
                                    src="https://seeklogo.com/images/H/hospital-clinic-plus-logo-7916383C7A-seeklogo.com.png" />
                            </div>
                            <div class="credentials">
                                <h4>Doctor(a)</h4>
                                <p><?=$data['full_name']?></p>

                            </div>
                            <div class="credentials">
                                <h4>Nome do Paciente</h4>
                                <p><?=$data['pacient_nomecompleto']?></p>
                                <h4>Tipo de Consulta</h4>
                                <p><?=$data['nome']?></p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="40%">
                        <div class="desease_details">
                            <div class="symptoms">
                                <h4 class="d-header">Sintomas</h4>
                                <ul class="symp" data-toggle="tooltip" data-placement="bottom">
                                    <p><?=$data['sintomas']?></p>
                                </ul>
                            </div>
                            <div class="tests">
                                <h4 class="d-header">Resultado</h4>
                                <ul class="tst" data-toggle="tooltip" data-placement="bottom">
                                    <p><?=$data['resultado']?></p>
                                </ul>
                            </div>
                            <div class="advice">
                                <h4 class="d-header">Observção medica</h4>
                                <p class="adv_text"><?=$data['comentario_medico']?></p>
                            </div>
                        </div>
                    </td>
                    <td width="60%" valign="top">
                        <span style="font-size: 3em;">Receita</span>
                        <hr />
                        <div class="medicine">
                            <section class="med_list">
                                <?=$data['descricao']?>
                            </section>
                            
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="button_group">
            <button onclick="window.print();" class="issue_prescription btn btn-success" id="print-btn">Print</button>
            <a class="issue_prescription btn btn-success" href="../receita.php">Voltar</a>
            <!-- <button class="pdf_prescription btn btn-danger">PDF</button> -->
        </div>
    </div>
</div>
