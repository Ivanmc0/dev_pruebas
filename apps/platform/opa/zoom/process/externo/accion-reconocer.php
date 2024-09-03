<?php require_once('../../../appInit.php');


if(!isset($_POST["id_reconocido"]) || $_POST["id_reconocido"] == 0){
    echo '<div class="colorRojo">Debe seleccionar un colega a quien otorgar un reconocimiento</div>';
    die();
}

echo '<script>$(document).ready(function(){ $(".paso2").slideDown(); });</script>';

if(!isset($_POST["id_reconocimiento"]) || $_POST["id_reconocimiento"] == 0){
    echo '<div class="colorRojo">Complete el paso 2: Debe seleccionar un reconocimiento para otorgar</div>';
    die();
}

echo '<script>$(document).ready(function(){ $(".paso3").slideDown(); });</script>';

if(!isset($_POST["comentarios"]) || $_POST["comentarios"] == ""){
    echo '<div class="colorRojo">Complete el paso 3: Debe sustentar el reconocimiento que otorgará</div>';
    die();
}

$_POST["fecha"] = date("Y-m-d H:i:s");
$insert = $_ZOOM->insert_data_array($_POST, "grw_sol_act_reconocimientos");


echo "";
echo '
    <div class="colorVerde">Reconocimiento otorgado correctamente</div>
    <script>
        setTimeout( function(){
            $("#modalCrearReconocimiento'.$_POST["id_dinamica"].'").modal("hide");
            document.getElementById("reconocer'.$_POST["id_dinamica"].'").reset();
            lele.actividad_listado_reconocimientos('.$_POST["id_dinamica"].','.$_POST["id_actividad"].','.$_POST["id_trabajador"].','.$_POST["id_empresa"].');
            $("#rtn-reconocer'.$_POST["id_dinamica"].'").html("");

        }, 1200);
    </script>
';
