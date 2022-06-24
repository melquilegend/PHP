<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php'; 
$tipo_consulta = $_GET['tipo_consulta'];
if ($tipo_consulta != "") {
    $statement = "SELECT id,full_name FROM doctores WHERE id= $tipo_consulta";
$dt = $db->query($statement);
echo "<label>Tipo de Consulta</label>";
echo "<select class='form-control default-select' name='doctor_id'>";
        while ($result = mysqli_fetch_array($dt)) {
      
            //echo '<option value="'.$result["id"].'">'.$result['full_name'];.'</option>';
            //echo "<option class="form-control default-select">";  echo $result['full_name']; echo "</option>";
            //echo "<option value="$result['id']">"; echo $result['full_name']; echo "</option>";
            $result1 .= "<option value=" . $result['id'] . ">" . $result['full_name'] . "</option>";
            echo $result1;
        }
echo "</select>";
}
?>