<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/sistemaclinica/core/init.php'; 
$tipo_consultaId = isset($_POST['tipo_consultaId']) ? $_POST['tipo_consultaId'] : 0;
$command = isset($_POST['get']) ? $_POST['get'] : "";

switch ($command) {
    case "tipo_consulta":
        $statement = "SELECT id,nome FROM tipo_consulta";
        $dt = $db->query($statement);
        while ($result = mysqli_fetch_array($dt)) {
            echo $result1 = "<option value=" . $result['id'] . ">" . $result['nome'] . "</option>";
        }
        break;

    case "medico":
        $result1 = "<option>Select State</option>";
        $statement = "SELECT id,full_name FROM doctores WHERE id=" . $tipo_consultaId;
        $dt = $db->query($statement);

        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value=" . $result['id'] . ">" . $result['full_name'] . "</option>";
        }
        echo $result1;
        break;
}

exit();
?>