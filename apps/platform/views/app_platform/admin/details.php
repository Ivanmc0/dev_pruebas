<?php

    if($mud = $_PLATFORM->PermissionValidationModel ($app, $geton[2], true)){

        $uid = explode('_', $geton[3]);

        include 'details/'.$mud['archivo'].'.php';

    } else  echo '<div class="p50 taC t30 ff0 tU">No posee permisos para cargar esta sección</div>';

?>