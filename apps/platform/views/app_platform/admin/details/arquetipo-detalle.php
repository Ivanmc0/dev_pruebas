<?php
    if($registro = $_ZOOM->get_data("grw_arquetipos", " AND uuid = '".$uid[0]."' AND id_empresa = ".$_SESSION['COMPANY']['id']." AND eliminado = 0 ", 0)){

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
                if(isset($botoneshabilitados['8eb37bfb-2126-11ef-93ea-b42e99a5cf9a'])){
                    $boton = $botoneshabilitados['8eb37bfb-2126-11ef-93ea-b42e99a5cf9a'];
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

    <div class="cloud mb50 mb30_oS">
        <div class="tab mb30">
            <div class="tabIn"><div class="t24 ff1">Información del registro</div></div>
            <div class="tabIn taR">
                <?php
                    if(isset($botoneshabilitados['8eaf4af6-2126-11ef-93ea-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['8eaf4af6-2126-11ef-93ea-b42e99a5cf9a'];
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
        <?php $color = $_ZOOM->get_data("olc_colores", " AND id = ".$registro["id_color"]." AND eliminado = 0 ", 0); ?>
        <div class="row bBS1 bCeee p2010 align-items-center">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Color Representativo</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="tab">
                    <div class="tabIn w30x">
                        <div class="bVerde2 wh30 rr50 bS2 bShadow3" <?php if($color) echo 'style="background-color:'.$color["nombre"].'"'; ?>></div>
                    </div>
                    <div class="tabIn pL10 t18 ff2 color333"><?php if($color) echo $color["background_nombre"]; ?></div>
                </div>
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
                <div class="t16 ff0 color666">Cita</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['cita']; ?></div>
            </div>
        </div>
    </div>

    <div class="cloud mb50 mb30_oS">
        <div class="tab mb30">
            <div class="tabIn"><div class="t24 ff1">Descripción Demográfica</div></div>
            <div class="tabIn taR">
                <?php
                    if(isset($botoneshabilitados['10f220be-2130-11ef-93ea-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['10f220be-2130-11ef-93ea-b42e99a5cf9a'];
                        $size = 'zs';
                        $perz = '';
                        include '../views/components/boton_float.php';
                    }
                ?>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Edad</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descr_demo_edad']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Género</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descr_demo_genero']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Nivel Socioeconómico</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descr_demo_socioeconomico']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Ubicación geográfica</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descr_demo_ubicacion']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Otros detalles</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descr_demo_otro']; ?></div>
            </div>
        </div>
    </div>

    <div class="cloud mb50 mb30_oS">
        <div class="tab mb30">
            <div class="tabIn"><div class="t24 ff1">Descripción Psicográfica</div></div>
            <div class="tabIn taR">
                <?php
                    if(isset($botoneshabilitados['5207dc13-2130-11ef-93ea-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['5207dc13-2130-11ef-93ea-b42e99a5cf9a'];
                        $size = 'zs';
                        $perz = '';
                        include '../views/components/boton_float.php';
                    }
                ?>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Intereses</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descr_psico_intereses']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Valores</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descr_psico_valores']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Estilo de vida</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descr_psico_estilovida']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Personalidad</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descr_psico_personalidad']; ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Otros detalles</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= $registro['descr_psico_otro']; ?></div>
            </div>
        </div>
    </div>

    <div class="cloud mb50 mb30_oS">
        <div class="tab mb30">
            <div class="tabIn"><div class="t24 ff1">Más características</div></div>
            <div class="tabIn taR">
                <?php
                    if(isset($botoneshabilitados['5aa8a199-2130-11ef-93ea-b42e99a5cf9a'])){
                        $boton = $botoneshabilitados['5aa8a199-2130-11ef-93ea-b42e99a5cf9a'];
                        $size = 'zs';
                        $perz = '';
                        include '../views/components/boton_float.php';
                    }
                ?>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Motivaciones y Necesidades</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= pintarLista($registro['motivaciones']); ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Comportamiento de Compra</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= pintarLista($registro['comportamiento_compra']); ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Desafíos y Puntos de Dolor</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= pintarLista($registro['desafios']); ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Objetivos y Aspiraciones</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= pintarLista($registro['objetivos']); ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Influencias y Decisores</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= pintarLista($registro['influencias']); ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Ejemplos de Prod/Serv Usados</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= pintarLista($registro['ejemplos']); ?></div>
            </div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Canales de Comunicación Preferidos</div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="t18 ff2 color333"><?= pintarLista($registro['canales']); ?></div>
            </div>
        </div>
    </div>


</div>


<?php

    } else {
        echo '<div class="p50 taC t30 ff0 tU">No se encontró o se eliminó el registro que busca</div>';
        echo '<script>setTimeout(function(){ history.back(); }, 2000);</script>';
    }

?>