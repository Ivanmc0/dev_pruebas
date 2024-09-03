<?php
    if($registro = $_ZOOM->get_data("grw_okr_proyectos", " AND uuid = '".$uid[0]."' AND id_empresa = ".$_SESSION['COMPANY']['id']." AND eliminado = 0 ", 0)){
        if($process = $_ZOOM->get_data("grw_procesos", " AND id_proceso_tipo = 4 AND id_proceso = ".$registro["id"]." AND eliminado = 0 ", 0)){
 
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
                if(isset($botoneshabilitados['81903d95-29ba-11ef-93c1-b42e99a5cf9a'])){
                    $boton = $botoneshabilitados['81903d95-29ba-11ef-93c1-b42e99a5cf9a'];
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
            echo '<div class="fR">';
            if(isset($botoneshabilitados['07059a3b-29c2-11ef-93c1-b42e99a5cf9a'])){
                $boton = $botoneshabilitados['07059a3b-29c2-11ef-93c1-b42e99a5cf9a'];
                $size = 'zs';
                $perz = '';
                include '../views/components/boton_float.php';
            }
            echo '</div>';
        ?>
        <div class="ff2 t18 mb5">En construcción</div>
        <div class="ff0 t14">Para publicar esta valoración, asegúrese de que se encuentra completa.</div>
    </div>
<?php }else{ ?>
    <div class="alert alert-success bShadow3 rr20 p2030 mb30 mb20_oS" role="alert">
        <?php
            echo '<div class="fR">';
            if(isset($botoneshabilitados['07059a3b-29c2-11ef-93c1-b42e99a5cf9a'])){
                $boton = $botoneshabilitados['07059a3b-29c2-11ef-93c1-b42e99a5cf9a'];
                $size = 'zs';
                $perz = '';
                include '../views/components/boton_float.php';
            }
            echo '</div>';
        ?>
        <div class="ff2 t18 mb5">Publicado</div>
        <div class="ff0 t14">Esta valoración es visible para los colaboradores en su alcance y periodo.</div>
    </div>
<?php } ?>


    <div class="cloud mb50 mb30_oS" style="overflow: hidden;">

        <div class="tab mb30">
            <div class="tabIn"><div class="t24 ff1">Información del registro</div></div>
            <div class="tabIn taR">
                <?php
                    if(isset($botoneshabilitados['818785ed-29ba-11ef-93c1-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['818785ed-29ba-11ef-93c1-b42e99a5cf9a'];
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
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['nombre']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Descripción</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descripcion']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Responsable</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333">
                    <?php
                        if($user = $_ZOOM->get_data('zoom_users', ' AND id = '.$registro['id_responsable'].' ', 0)){
                            echo $user['nombres'].' '.$user['apellidos'];
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Desde</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333">
                    <?php
                        if($user = $_ZOOM->get_data('olc_semanas', ' AND id = '.$registro['id_semana_desde'].' ', 0)){
                            echo 'Semana '.$user['semana'].' de '.$user['ano'].' ('.$user['fecha_desde'].'/'.$user['fecha_hasta'].')';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Hasta</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333">
                    <?php
                        if($user = $_ZOOM->get_data('olc_semanas', ' AND id = '.$registro['id_semana_hasta'].' ', 0)){
                            echo 'Semana '.$user['semana'].' de '.$user['ano'].' ('.$user['fecha_desde'].'/'.$user['fecha_hasta'].')';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>



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