<?php

    $_WORKERS->PerfilCompleto($_SESSION['WORKER']);

    $thisUser = $_ZOOM->get_data("zoom_users", " AND uuid = '".$_SESSION['WORKER']['uuid']."' AND eliminado = 0 ", 0);

    if($mud = $_PLATFORM->PermissionValidationModel ($app, $geton[0])){
        $registro           = $_SESSION['WORKER'];
        $fath               = $registro["id"];
        $id_rol             = 110;
        $pnl                = 0;
        $condicion          = " AND model.id_modulo = ".$mud['id'];
        $botoneshabilitados = $_ZOOM->order_array_by($_TUCOACH->getOpcionesPorRol( $id_rol, $app, $condicion ), 'uuid');
     }

    if($_SESSION['WORKER']['posicion_ok'] === 0 || $_SESSION['WORKER']['segmentacion_ok'] === 0){

?>

<div class="bRojo4 posA w100 bBS2 bCeee" style="top:0; left:0">
    <div class="general1600">
        <div class="tab pAA30">
            <div class="tabIn w50x">
                <a href="<?= $dominion; ?>tablero/" class="">
                    <div class="wh50 rr50 t30 bHover2"><div class="vMM rr50"><i class="las la-arrow-left"></i></div></div>
                </a>
            </div>
            <div class="tabIn w70x pLR10">
                <div class="bRojo2 colorfff wh50 rr50 t30"><div class="vMM rr50"><i class="las la-exclamation"></i></div></div>
            </div>
            <div class="tabIn pL10">
                <div class="t30 color000 ff1"><?= $thisUser['nombre']; ?>, tu perfil esta incompleto.</div>
            </div>
        </div>
    </div>
</div>

<div class="h100 h50_oS"></div>

<div class="generalMin">

    <div class="row align-items-center mb50">
        <div class="col-12 col-lg-7">
            <div class="w80 t20 ff0 color333">
                Completa tu perfil. De este modo, podrás acceder a todas
                las actividades, tareas, proyectos y otras dinámicas que tiene
                la plataforma para transformar la cultura organizacional
                de la compañia.
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <img src="<?= $dominion; ?>resources/img/perfilado.png" />
        </div>
    </div>

    <div class="row align-items-center">

        <?php
            if($_SESSION['WORKER']['posicion_ok'] === 0){
                echo '<div class="col-12 col-lg-6">';
                include 'components/perfilado-posicion.php';
                echo '</div>';
            }
            if($_SESSION['WORKER']['segmentacion_ok'] === 0){
                echo '<div class="col-12 col-lg-6">';
                include 'components/perfilado-segmentacion.php';
                echo '</div>';
            }
        ?>

    </div>

</div>

<?php }else { ?>

<div class="bVerde4 posA w100 bBS2 bCeee" style="top:0; left:0">
    <div class="general1600">
        <div class="tab pAA30">
            <div class="tabIn w50x">
                <a href="<?= $dominion; ?>tablero/" class="">
                    <div class="wh50 rr50 t30 bHover2"><div class="vMM rr50"><i class="las la-arrow-left"></i></div></div>
                </a>
            </div>
            <div class="tabIn w70x pLR10">
                <div class="bVerde2 colorfff wh50 rr50 t30"><div class="vMM rr50"><i class="las la-check"></i></div></div>
            </div>
            <div class="tabIn pL10">
                <div class="t30 color000 ff1"><?= $thisUser['nombre']; ?>, tu perfil esta completo.</div>
            </div>
        </div>
    </div>
</div>

<div class="h100"></div>


<div class="generalMin">

    <div class="tab mb50">
        <div class="tabIn w120x w60x">
            <div class="wh120 wh60_oS rr50 bMorado colorfff ff3 t50"><div class="vMM w100 h100_"><?= $sigla; ?></div></div>
        </div>
        <div class="tabIn pLR20 pLR10_oS">
            <div class="t50 color000 ff3 mb10">Hola, <?= $thisUser['nombres']; ?></div>
            <div class="t20 color333 ff1">Aquí está la información registrada sobre ti en la plataforma</div>
        </div>
    </div>

    <div class="bfff bShadow3 rr20 p30 p20_oS mb50 mb30_oS" style="overflow: hidden;">

        <div class="t24 ff1 mb30">
            <div class="fR">
                <?php
                    if(isset($botoneshabilitados['99273ae5-120a-11ef-938b-b42e99a5cf9a'])){
                        $boton         = $botoneshabilitados['99273ae5-120a-11ef-938b-b42e99a5cf9a'];
                        $boton['tipo'] = 1;
                        $size          = 'zs';
                        $perz          = '';
                        include '../views/components/boton_float.php';
                    };
                ?>
            </div>
            Información básica
        </div>

        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Nombres</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $thisUser['nombres']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Apellidos</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $thisUser['apellidos']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Identificación</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333">CC. <?= $thisUser['identificacion']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Correo electrónico</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $thisUser['email']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>

        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Celular</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $thisUser['celular']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>


        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Fecha nacimiento</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>


    </div>

    <div class="bfff bShadow3 rr20 p30 p20_oS mb50 mb30_oS" style="overflow: hidden;">

        <div class="t24 ff1 mb30">
            <div class="fR">
                <?php
                    if(isset($botoneshabilitados['a48cfd6c-120a-11ef-938b-b42e99a5cf9a'])){
                        $boton         = $botoneshabilitados['a48cfd6c-120a-11ef-938b-b42e99a5cf9a'];
                        $boton['tipo'] = 1;
                        $size          = 'zs';
                        $perz          = '';
                        include '../views/components/boton_float.php';
                    };
                ?>
            </div>
            Posición Organizacional
        </div>

        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Cargo</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?= $_SESSION['WORKER']['cargo']; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
        <div class="row bBS1 bCeee p2010">
            <div class="col-12 col-lg-4">
                <div class="t16 ff0 color666">Jefe directo</div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="t18 ff2 color333"><?php if($_SESSION['WORKER']['nom_jefe'] != 0) echo $_SESSION['WORKER']['nom_jefe']; else '<i>No tiene jefe</i>'; ?></div>
            </div>
            <div class="col-12 col-lg-1 taR"><i class="las la-check t20 colorVerde"></i></div>
        </div>
    </div>


    <div class="bfff bShadow3 rr20 p30 p20_oS mb50 mb30_oS" style="overflow: hidden;">

        <div class="t24 ff1 mb30">
            <div class="fR">
                <?php
                    if(isset($botoneshabilitados['a72c5c84-120a-11ef-938b-b42e99a5cf9a'])){
                        $boton         = $botoneshabilitados['a72c5c84-120a-11ef-938b-b42e99a5cf9a'];
                        $boton['tipo'] = 1;
                        $size          = 'zs';
                        $perz          = '';
                        include '../views/components/boton_float.php';
                    };
                ?>
            </div>
            Segmentación Básica
        </div>

        <?php
            if($_SESSION['WORKER']['segmentacion']){
                foreach ($_SESSION['WORKER']['segmentacion'] as $key => $seg) {
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


</div>



<?php } ?>