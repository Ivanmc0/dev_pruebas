<?php  require_once ('../../appInit.php');

  

    $data = array(
        'id'        => $_POST['id_respues'],
        'respuesta' => $_POST['respues'],
    );


    if($_ZOOM->update_data_array($data, 'grw_sol_act_encuestas', 'id', $data['id'])){

        echo '<script>setTimeout(function(){ history.back(); }, 1);</script>';

    } else{

        echo 'Hubo un error guardando su respuesta, intentelo más tarde.';

    }