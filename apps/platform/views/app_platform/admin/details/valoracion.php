<?php
    if($registro = $_ZOOM->get_data("grw_val_valoraciones", " AND uuid = '".$uid[0]."' AND id_empresa = ".$_SESSION['COMPANY']['id']." AND eliminado = 0 ", 0)){
        if($process = $_ZOOM->get_data("grw_procesos", " AND id_proceso_tipo = 5 AND id_proceso = ".$registro["id"]." AND eliminado = 0 ", 0)){

 

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
                if(isset($botoneshabilitados['fd60b0d9-1c61-11ef-938f-b42e99a5cf9a'])){
                    $boton = $botoneshabilitados['fd60b0d9-1c61-11ef-938f-b42e99a5cf9a'];
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
            if(isset($botoneshabilitados['50338d4c-1c63-11ef-938f-b42e99a5cf9a'])){
                $boton = $botoneshabilitados['50338d4c-1c63-11ef-938f-b42e99a5cf9a'];
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
            if(isset($botoneshabilitados['50338d4c-1c63-11ef-938f-b42e99a5cf9a'])){
                $boton = $botoneshabilitados['50338d4c-1c63-11ef-938f-b42e99a5cf9a'];
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
                    if(isset($botoneshabilitados['fd58f497-1c61-11ef-938f-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['fd58f497-1c61-11ef-938f-b42e99a5cf9a'];
                        $size = 'zs';
                        $perz = '';
                        include '../views/components/boton_float.php';
                    }
                    if($registro['id_tipo'] == 1){
                        if(isset($botoneshabilitados['84d020b8-1c63-11ef-938f-b42e99a5cf9a'])){
                            $boton = $botoneshabilitados['84d020b8-1c63-11ef-938f-b42e99a5cf9a'];
                            $size = 'zs';
                            $perz = '';
                            include '../views/components/boton_builder.php';
                        }
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
                <div class="t16 ff0 color666">Tipo</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333">
                    <?= $registro['id_tipo'] == 1 ? 'Journey' : 'Evento'; ?>
                </div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Expectativas de la valoración</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['expectativas']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Escenarios</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['escenarios']; ?></div>
            </div>
        </div>
    </div>

    <?php
        if($registro['id_tipo'] == 2){
            if($eventos = $_VALORA->GetEvents('eve.id_valoracion = '.$registro["id"])){
                $eventos = $eventos["0_0"];
                echo '<div class="cloud tablion">';

                foreach ($eventos["eventos"] as $evento) {
                    include 'app_valora/components/evento.php';
                }

                echo '</div>';
            }
        }
    ?>

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