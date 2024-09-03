<?php include 'jobsInit.php';

    //, 'ingenieria@olcgroup.co'

    $lista_marketing = 5;

    if($list = $_ZOOM->get_data('mkt_masivo_encuesta_disc', ' AND id_campana = '.$lista_marketing.' AND enviado = 0 AND inactivo = 0 AND eliminado = 0 LIMIT 50 ', 1)) {

        foreach ($list as $key => $value) {


            if($_MAILS->SendMail('campana3', 'gerencia', $value['email'], $value)) {

                $_ZOOM->update_data_array(['enviado' => '1'], 'mkt_masivo_encuesta_disc', 'id', $value['id']);
                echo 'Email enviado: '.$value['id'].PHP_EOL;

            } else {

                $_ZOOM->update_data_array(['enviado' => '2'], 'mkt_masivo_encuesta_disc', 'id', $value['id']);
                echo 'Error al enviar email: '.$value['id'].PHP_EOL;

            }
        }

    }

?>