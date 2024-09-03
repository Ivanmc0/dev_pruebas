<?php require_once('../../../appInit.php');


if(!isset($_POST["comentarios"]) || $_POST["comentarios"] == ""){
    echo '<div class="colorRojo">Indique las ideas que quiera aportar</div>';
    die();
}

$_POST["fecha"] = date("Y-m-d H:i:s");
$insert = $_ZOOM->insert_data_array($_POST, "grw_sol_act_campanias");

echo '
    <div class="colorVerde">Aporte realizado correctamente</div>
    <script>
        setTimeout( function(){
            $("#modalCrearIdea'.$_POST["id_dinamica"].'").modal("hide");
            document.getElementById("idear'.$_POST["id_dinamica"].'").reset();
            lele.actividad_listado_campanas('.$_POST["id_dinamica"].','.$_POST["id_actividad"].','.$_POST["id_trabajador"].','.$_POST["id_empresa"].');
            $("#rtn-idear'.$_POST["id_dinamica"].'").html("");
        }, 1200);
    </script>
';