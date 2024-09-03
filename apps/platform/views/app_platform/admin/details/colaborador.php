<?php
    if($registro =  $_GROWI->GET('COMPANY', 'GetColaborators', $AddToQuery = " AND uuid = '".$uid[0]."' ", ['empresa' => 'USERS.id_empresa'], $ReturnRecord = true) ){


        $id_rol     = $_SESSION["ADMIN"]['id'];
        $fath       = 0;
        $condicion  = " AND model.id_modulo = ".$mud['id'];
        $misBotones = '';

        $botoneshabilitados = $_ZOOM->order_array_by($_TUCOACH->getOpcionesPorRol( $id_rol, $app, $condicion ), 'uuid');

        echo '
            <div class="tab bBS1 bCeee pAA20 mb50">
                <div class="tabIn w60x w50x_oS">
                    <div class="wh50 wh40_oS rr50 bfff color000 t30 bHover cP" onclick="history.back()"><div class="vMM w100 h100_"><i class="las la-arrow-left"></i></div></div>
                </div>
                <div class="tabIn pLR20 pLR10_oS">
                    <div class="t30 ff4 color000 mb10">'.$mud['titulo'].'</div>
                    <div class="t18 ff2 color666">'.$mud['descripcion'].' '.$registro['nombre_completo'].' '.'</div>
                </div>
                <div class="tabIn taR">
        ';
                if(isset($botoneshabilitados['b139e8de-070d-11ef-9372-b42e99a5cf9a'])){
                    $boton = $botoneshabilitados['b139e8de-070d-11ef-9372-b42e99a5cf9a'];
                    $size = 'zs';
                    $perz = '';
                    include '../views/components/boton_float.php';
                }
        echo '
                </div>
            </div>
        ';

?>


<div class="generalMin">

    <div class="bfff bShadow3 rr20 p30 p20_oS mb50 mb30_oS" style="overflow: hidden;">

        <div class="tab mb30">
            <div class="tabIn"><div class="t24 ff1">Información básica</div></div>
            <div class="tabIn taR">
                <?php
                    if(isset($botoneshabilitados['03c543f5-071d-11ef-9372-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['03c543f5-071d-11ef-9372-b42e99a5cf9a'];
                        $size = 'zs';
                        $perz = '';
                        include '../views/components/boton_float.php';
                    }
                ?>
            </div>
        </div>

        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Estado</div>
            </div>
            <div class="col-12 col-lg-8 taR">
                <?php if($registro['inactivo'] != 1){ ?><div class="dIB bVerde colorfff p510 rr5 t14"><i class="las la-check-circle"></i><span class="pL5 ff1">Activo</span></div><?php } ?>
                <?php if($registro['inactivo'] != 0){ ?><div class="dIB bRojo colorfff p510 rr5 t14"><i class="las la-minus-circle"></i><span class="pL5 ff1">Inactivo</span></div><?php } ?>
            </div>
        </div>

        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Nombres</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['nombres']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Apellidos</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['apellidos']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Identificación</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['identificacion_completa']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Correo electrónico</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['datos_contacto']['correo']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>

        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Celular</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['datos_contacto']['celular']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>

        <div class="row bBS1- bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Teléfono</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['datos_contacto']['telefono']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        
    </div>


 

    <div class="bfff bShadow3 rr20 p30 p20_oS mb50 mb30_oS" style="overflow: hidden;">

        <div class="t24 ff1 mb30">Posición Organizacional</div>

        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Cargo</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['cargo']['nombre']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Jefe directo</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['jefe']['nombre_completo'];  ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
    </div>



<!--


    <div class="bfff bShadow3 rr20 p30 p20_oS mb50 mb30_oS" style="overflow: hidden;">

        <div class="t24 ff1 mb30">Segmentación Básica</div>

        <?php
            if($registro['segmentacion']){
                foreach ($registro['segmentacion'] as $key => $seg) {
        ?>
                    <div class="row bBS1 bCeee p2010">
                        <div class="col-12 col-lg-4">
                            <div class="t16 ff0 color666"><?= $seg['nom_param']; ?></div>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="t18 ff2 color333"><?= $seg['nom_opcion']; ?></div>
                        </div>
                        <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
                    </div>
        <?php } } ?>
    </div>
    -->

</div>




<?php

    } else {
        echo '<div class="p50 taC t30 ff0 tU">No se encontró o se eliminó el registro que busca</div>';
        echo '<script>setTimeout(function(){ history.back(); }, 2000);</script>';
    }

?>