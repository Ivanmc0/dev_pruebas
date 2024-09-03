<?php  require_once ('../../appInit.php');

if(isset($_POST["id"])) $id = trim($_POST["id"]); else $id = "";

$insert = 0;
$update = 0;

if($id == ""){
    $_POST["fecha"] = date("Y-m-d H:i:s");
    $insert = $_ZOOM->insert_data_array($_POST, "olc_trabajadores_cargo");
} else {
    $update = $_ZOOM->update_data_array($_POST, "olc_trabajadores_cargo", "id", $id);
}

if($insert != 0) {
    echo "<div class='colorVerde'>Registro creado correctamente</div>";
    echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';
}
if($update != 0){
    echo '<div class="colorVerde">Los cambios se han guardado correctamente</div>';
    echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';
}
