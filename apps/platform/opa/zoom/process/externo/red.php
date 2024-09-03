<?php require_once('../../../appInit.php');

$data = array(
    "nivel" => $_POST["nivel"],
    "red"   => unserialize($_POST["array"])
);


if(isset($data["red"])){

    foreach($data["red"] AS $user){

        $trab = "";
        if(isset($user["trabajadores"])){
            foreach ($user["trabajadores"] as $key => $tra) {
                $trab .= '<div class="p1020 bS1 bCVerde2" style="margin-top:-1px">'.$tra["nombre"].'</div>';
            }
        }

        $nivel = $data["nivel"]."-".$user["id"];
        echo '
            <div id="'.$nivel.'">
                <div class="tab pAA10">
                    <div class="tabIn"><div class="colorVerde bfff t16 ff3 p1020">'.$user["nombre"].' </div></div>
                </div>
                <div class="pLR20" style="padding-right:0">
        ';

        if(isset($user["trabajadores"])){
            echo '<div class="dN listTrabajadores">';
            echo '<div class="p1020 bVerde2" style="padding-right:0">Colaboradores</div>';
            echo $trab;
            echo '</div>';

        }// else echo '<div class="p1020 bGray color666" style="padding-right:0">No hay colaboradores</div>';

        if(isset($user["hijos"])) echo '
                    <div class="p1020 bVerde2" style="padding-right:0">Subcargos</div>
                    <div class="contenido bS1 bCVerde2" style="margin-top:-1px"></div>
        ';// else echo '<div class="p1020 bGray color666" style="padding-right:0">No hay Subcargos</div>';
        echo '
                </div>
            </div>
        ';

        if(isset($user["hijos"])) echo '<script>lele.red("'.$nivel.'", \''.serialize($user["hijos"]).'\');  </script>';
    }
}

 





/*

require_once('../../../zoom/class/classZoom.php');
$_ZOOM = new Zoom();

$insert_data    = 0;
$insert         = 0;

foreach ($_POST as $key => $val) {
    if (strpos($key, 'pregunta') !== false) {
        if ($val != '') {
            $param = explode('_', $key);
            $id_dinamica = $param[1];
            $id_pregunta = $param[2];
            $getData = $_ZOOM->get_data('grw_sol_act_encuestas', ' AND id_dinamica = ' . $id_dinamica . ' AND id_pregunta = ' . $id_pregunta . ' AND id_trabajador = ' . $_POST['id_trabajador'] . ' AND id_actividad = ' . $_POST['id_actividad'], 0);
            if ($getData) {
                $data_insert = array();
                if (isset($param[3])) {

                    if ($param[3] == 'a'){
                        $data_insert['respuesta'] = $val;
                    } else {
                        $data_insert['id_respuesta_multiple'] = implode(',', $val);
                    }

                } else $data_insert['id_respuesta'] = $val;

                $insert = $_ZOOM->update_data_array($data_insert, 'grw_sol_act_encuestas', 'id', $getData['id']);

            } else {

                $data = array(
                    'id_dinamica' => $id_dinamica,
                    'id_pregunta' => $id_pregunta,
                    'id_trabajador' => $_POST['id_trabajador'],
                    'id_empresa' => $_POST['id_empresa'],
                    'id_actividad' => $_POST['id_actividad'],
                    'fecha' => date('Y-m-d H:i:s')
                );

                if (isset($param[3])) {
                    if ($param[3] == 'a') $data['respuesta'] = $val;
                    else {
                        $data['id_respuesta_multiple'] = implode(',', $val);
                    }
                } else $data['id_respuesta'] = $val;

                $insert = $_ZOOM->insert_data_array($data, 'grw_sol_act_encuestas');

            }

            $insert_data += $insert;

        } else {
            echo "<div class='colorRojo'>Todos los campos son obligatorios</div>";
        }
    }
}

if ($insert_data > 0) {
    echo "<div class='colorVerde ff3'>Actualizado con éxito</div>";
    echo '<script>setTimeout(function(){ location.reload(); }, 1500);</script>';
} else echo "<div class='colorRojo'>Error al guardar los datos</div>";

*/