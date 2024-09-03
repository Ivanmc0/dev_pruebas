<?php

    $iDinamic = uniqid();

    $rreg = ($boton["tipo"] != 1) ? 'object-'.$iDinamic : 0;

    if($boton["url"] == 'modal'){
        $enlace = 'div onclick="Crudion.Run(
                \'event-'.$iDinamic.'\',
                \''.$mud['cody'].'\',
                \''.$boton['uuid'].'\',
                \''.$rreg.'\',
                \''.$fath.'\',
                1)"';
        $enlace2 = 'div';
    } else {
        $enlace = 'a href="'.$_SESSION['_DOMINION'].$boton["url"].$rreg.'/"';
        $enlace2 = 'a';
    }


    $unBoton = '
        <div class="dIB">
            <'.$enlace.' class="btn-'.$boton["tipo"].' btn-'.$size.'">
                <i class="'.$boton["icono"].'"></i>
                <span style="'.$perz.'">'.$boton["modulo"].'</span>
            </'.$enlace2.'>
            <div id="rtn-event-'.$iDinamic.'" style="width:0; height:0; overflow:hidden"></div>
        </div>
    ';

?>