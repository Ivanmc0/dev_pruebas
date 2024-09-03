<?php
    if(


        $registro = $_GROWI->GET('LELE', 'GetActividades', $AddToQuery=" AND ACTIV.uuid = '".$uid[0]."'" , ['empresa' => 'ACTIV.id_empresa'], $ReturnRecord = true)

        )

        {
        if($process = $_ZOOM->get_data("grw_procesos", " AND id_proceso_tipo = 3 AND id_proceso = ".$registro["id"]." AND eliminado = 0 ", 0)){



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
                if(isset($botoneshabilitados['c025ee1f-1190-11ef-98cf-b42e99a5cf9a'])){
                    $boton = $botoneshabilitados['c025ee1f-1190-11ef-98cf-b42e99a5cf9a'];
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


<?php if($process['visible'] == 0){ ?>
    <div class="alert alert-warning bShadow3 rr20 p2030 mb30 mb20_oS" role="alert">
        <?php
            if($hijole = $_ZOOM->get_data("grw_lel_dinamicas", " AND id_actividad = ".$registro['id']." AND eliminado = 0 ORDER BY inactivo ASC, nombre ASC ", 1)){
                echo '<div class="fR">';
                if(isset($botoneshabilitados['1fdf645d-12f2-11ef-93d8-b42e99a5cf9a'])){
                    $boton = $botoneshabilitados['1fdf645d-12f2-11ef-93d8-b42e99a5cf9a'];
                    $size = 'zs';
                    $perz = '';
                    include '../views/components/boton_float.php';
                }
                echo '</div>';
            }
        ?>
        <div class="ff2 t18 mb5">En construcción</div>
        <div class="ff0 t14">Para publicar esta actividad, debe contar con los requisitos mínimos: debe contener al menos 1 interactividad completa.</div>
    </div>
<?php }else{ ?>
    <div class="alert alert-success bShadow3 rr20 p2030 mb30 mb20_oS" role="alert">
        <?php
            echo '<div class="fR">';
            if(isset($botoneshabilitados['1fdf645d-12f2-11ef-93d8-b42e99a5cf9a'])){
                $boton = $botoneshabilitados['1fdf645d-12f2-11ef-93d8-b42e99a5cf9a'];
                $size = 'zs';
                $perz = '';
                include '../views/components/boton_float.php';
            }
            echo '</div>';
        ?>
        <div class="ff2 t18 mb5">Publicado</div>
        <div class="ff0 t14">Esta actividad es visible para los colaboradores en su alcance y periodo.</div>
    </div>
<?php } ?>


    <div class="bfff bShadow3 rr20 p30 p20_oS mb50 mb30_oS" style="overflow: hidden;">

        <div class="tab mb30">
            <div class="tabIn"><div class="t24 ff1">Información del registro</div></div>
            <div class="tabIn taR">
                <?php
                    if(isset($botoneshabilitados['c02edc3e-1190-11ef-98cf-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['c02edc3e-1190-11ef-98cf-b42e99a5cf9a'];
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
                <div class="t16 ff0 color666">Nombre</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['nombre']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Descripción</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['descripcion']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Categoría</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $registro['categoria']['nombre']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
    </div>


<?php
    if($mud = $_PLATFORM->PermissionValidationModel ($app, 'interactividades', true)){
?>

    <div class="row align-items-center bBS1 bCeee pAA20 mb30">

        <div class="col-12 col-lg-6">
            <h2 class="t24 ff4 color000 mb10"><?= $mud['titulo']; ?></h2>
            <h5 class="t16 ff2 color666"><?= $mud['descripcion']; ?></h5>
        </div>
        <div class="col-12 col-lg-6 taR">
            <div id="rtn-botones-<?= $mud['cody']; ?>" class="fR submodule"></div>
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

<?php } ?>


</div>


<?php

        } else {
            echo '<div class="p50 taC t30 ff0 tU">No se encontró o se eliminó el registro que busca</div>';
            echo '<script>setTimeout(function(){ history.back(); }, 2000);</script>';
        }

    } else {
        echo '<div class="p50 taC t30 ff0 tU">No se encontró o se eliminó el registro que busca</div>';
        echo '<script>setTimeout(function(){ history.back(); }, 2000);</script>';
    }

?>