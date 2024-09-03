<?php
    $AddToQuery = "AND ACTIV_MODELOS.uuid='$uid[0]'" ;

    


    if( $registro  = $_GROWI->GET('LELE', 'GetInterActividades', $AddToQuery , ['empresa' => 'ACTIV_MODELOS.id_empresa'], $ReturnRecord = true) ){

        $modelo = $registro['modelo']['id'];


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
                    <div class="t18 ff2 color666">'.$mud['descripcion'].' '.$registro['nombre'].'</div>
                </div>
                <div class="tabIn taR">
        ';
                if(isset($botoneshabilitados['925a3126-12fc-11ef-93d8-b42e99a5cf9a'])){
                    $boton = $botoneshabilitados['925a3126-12fc-11ef-93d8-b42e99a5cf9a'];
                    $size = 'zs';
                    $perz = '';
                    include '../views/components/boton_float.php';
                };
        echo '
                </div>
            </div>
        ';

?>


<div class="generalMin">

    <div class="bfff bShadow3 rr20 p30 p20_oS mb50 mb30_oS" style="overflow: hidden;">

        <div class="tab mb30">
            <div class="tabIn"><div class="t24 ff1">Información del registro</div></div>
            <div class="tabIn taR">
                <?php
                    if($modelo == 1 && isset($botoneshabilitados['615673c7-12f8-11ef-93d8-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['615673c7-12f8-11ef-93d8-b42e99a5cf9a'];
                        $size = 'zs';
                        $perz = '';
                        include '../views/components/boton_float.php';
                    }
                    if($modelo == 2 && isset($botoneshabilitados['616361c7-12f8-11ef-93d8-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['616361c7-12f8-11ef-93d8-b42e99a5cf9a'];
                        $size = 'zs';
                        $perz = '';
                        include '../views/components/boton_float.php';
                    }
                    if($modelo == 3 && isset($botoneshabilitados['61797af2-12f8-11ef-93d8-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['61797af2-12f8-11ef-93d8-b42e99a5cf9a'];
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
                <?php if($registro['inactivo'] == 0){ ?><div class="dIB bVerde colorfff p510 rr5 t14"><i class="las la-check-circle"></i><span class="pL5 ff1">Activo</span></div><?php } ?>
                <?php if($registro['inactivo'] == 1){ ?><div class="dIB bRojo colorfff p510 rr5 t14"><i class="las la-minus-circle"></i><span class="pL5 ff1">Inactivo</span></div><?php } ?>
            </div>
        </div>

        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <?php if($modelo == 1){ ?><div class="t16 ff0 color666">Nombre de la encuesta.</div><?php } ?>
                <?php if($modelo == 2){ ?><div class="t16 ff0 color666">Título de la interactividad de reconocimiento.</div><?php } ?>
                <?php if($modelo == 3){ ?><div class="t16 ff0 color666">Pregunta, temática o idea de participación.</div><?php } ?>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['nombre']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>

        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4"><div class="t16 ff0 color666">Modelo de interactividad.</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['modelo']['nombre']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>

        <?php if($modelo == 1){ ?>
            <div class="row bBS1 bCeee p2010">
                <div class="col-12 col-lg-4"><div class="t16 ff0 color666">Tipo de encuesta.</div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="t18 ff2 color333"><?= $registro['tipo']['nombre']; ?></div>
                </div>
                <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
            </div>
        <?php } ?>


        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4"><div class="t16 ff0 color666">Orden.</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['prioridad']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>

    </div>





<?php
    if($modelo == 1){
        if($mud = $_PLATFORM->PermissionValidationModel ($app, 'inter-preguntas', true)){
            
            
?>

    <div class="row align-items-center bBS1 bCeee pAA20 mb30">

        <div class="col-12 col-lg-7">
            <h2 class="t24 ff4 color000 mb10"><?= $mud['titulo']; ?></h2>
            <h5 class="t16 ff2 color666"><?= $mud['descripcion']; ?></h5>
        </div>
        <div class="col-12 col-lg-5 taR">
            <div id="rtn-botones-<?= $mud['cody']; ?>" class="fR"></div>
        </div>

    </div>

    <div id="front-list"></div>

    <script>
        $(document).ready(function(){
            Crudion.GenerateBottoms(1, '<?= $mud['cody']; ?>', '<?= $app; ?>', 1, <?= $registro['id']; ?>);
            Crudion.GenerateBottoms(2, '<?= $mud['cody']; ?>', '<?= $app; ?>', 1);
            Crudion.GetList('<?= $mud['cody']; ?>', <?= $registro['id']; ?>);
            Crudion.Intenso('<?= $mud['cody']; ?>');
        });
    </script>

<?php
        }
    }
?>


</div>


<?php

    } else {
        echo '<div class="p50 taC t30 ff0 tU">No se encontró o se eliminó el registro que busca</div>';
        echo '<script>setTimeout(function(){ history.back(); }, 2000);</script>';
    }

?>