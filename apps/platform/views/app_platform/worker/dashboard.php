<div class="tab mb30">
    <div class="tabIn w300x pR20" style="vertical-align: top;">

        <div class="bfff bShadow3 rr20" style="overflow: hidden;">

            <div class="p1530 posR">
                <div id="clime-image" class="posA w50 h100_" style="top:-10px; right:10px; max-width:128px; background-image:url(<?= $dominion; ?>resources/img/clima/cloud.png); background-repeat:no-repeat; background-size: 100% auto;"></div>
                <div class="h90 mb3"></div>
                <div class="ff1 t30 colorMorado mb10"><span id="clime-time">0:00</span><span id="clime-sec" class="t12 color999 ff2 w10x dIB">00</span> <span id="clime-zone">mm</span></div>
                <div class="ff1 t18 colorMorado2"><span id="clime-day">Día</span>, <span id="clime-date"># del mes</span></div>
            </div>

            <div class="p1530">
                <div class="ff1 color000 t24 mb15">Buenos días,</div>
                <div class="ff4 truncate-2 color333 h50 t24 mb20"><?= $_SESSION['WORKER']['nombre_completo']; ?></div>

                <div class="tab">
                    <div class="tabIn w60x w40x_oS">
                        <div class="wh60 wh40_os rr50 bMorado colorfff ff3 t24"><div class="vMM w100 h100_"><?= $sigla; ?></div></div>
                    </div>
                    <div class="tabIn pL10 pLR10_oS">
                        <div class="color999 ff1 t16 mb5"><?php if($_SESSION['WORKER']["cargo"] != 0) echo $_SESSION['WORKER']["cargo"]; else echo '<i class="colorRojo">Sin cargo</i>'; ?></div>
                        <div class="color333 ff4 t16"><?= ($_SESSION['COMPANY']["nombre"]); ?></div>
                    </div>
                </div>
                <div class="h10"></div>

            </div>

            <div class="beee bShadow2 p20"></div>

        </div>

    </div>
    <div class="tabIn" style="vertical-align: top;">

        <div class="ff3 t24 color000 p1020 mb10">Esto es un resumen de lo que tenemos para ti hoy</div>

        <div class="row m0 p0">

            <?php
                $PeriodoInicial = '2024-01-01 00:00:00';
                $PeriodoFinal   = '2024-12-31 23:59:59';

                $_WORKERS->PerfilCompleto($_SESSION['WORKER']);

                if(($_SESSION['WORKER']['posicion_ok'] === 1 && $_SESSION['WORKER']['segmentacion_ok'] === 1) || $_SESSION['COMPANY']['id'] == 180){
                    if($datapps = $_WORKERS->GetProcesses($_SESSION['COMPANY']['id'], $_SESSION['WORKER']['id'], $PeriodoInicial, $PeriodoFinal) ){
                        $comercial = [];
                        foreach ($datapps as $appHabil => $aplicacion) {
                            $appData = $apps[$appHabil];
                            if($aplicacion){
                                echo '<div class="col-12 col-xl-2dot4 pLR10">';
                                include 'components/aplicacion.php';
                                echo '</div>';
                            } else $comercial[$appHabil] = $aplicacion;
                        }

                        if($comercial){
                            foreach ($comercial as $appHabil => $aplicacion) {
                                $appData = $apps[$appHabil];
                                echo '<div class="col-12 col-xl-2dot4 pLR10">';
                                include 'components/aplicacion-comercial.php';
                                echo '</div>';
                            }
                        }

                    }else echo MsgError("No hay datos");
                }else {

                    echo '<div class="col-12 pLR10">';
                    include 'components/perfilado-incompleto.php';
                    echo '</div>';

                }
            ?>

        </div>
    </div>
</div>


<?php if($grupos = $_GROWI->GET("Platform", "getGrupos", $AddToQuery = ' AND MIE.id_trabajador = '.$_SESSION['WORKER']['id'].' AND MIE.es_lider = 1 ', [], false )){ ?>

<div class="tab bfff bShadow3 rr20 mb30" style="overflow:hidden;">
    <div class="tabIn w300x bGrowi2 pR20">

        <div class="tab bGrowi2 h300" style="overflow: hidden;">
            <div class="tabIn">

                <div class="tab w200x mAUTO">
                    <div class="tabIn vaT w50x"><div class="t40 colorGrowi"><i class="las la-calendar"></i></div></div>
                    <div class="tabIn vaT"><div class="t24 colorGrowi ff3">Mis grupos corporativos</div></div>
                </div>

            </div>
        </div>

    </div>
    <div class="tabIn bfff p2040">
        <div class="row">
            <?php foreach ($grupos as $grupo) { ?>
                <div class="col-6 col-lg-3">
                    <a href="../grupo/<?= $grupo["uuid"]; ?>/">
                        <div class="tab h60 bGrowi2 bShadow3 rr15 ofH color000 grover cP m-1">
                            <div class="tabIn pLR20 taL">
                                <div class="ff3 t16 colorGrowi truncate-1 mb3"><?= $grupo["nombre"]; ?></div>
                                <div class="ff1 t14 color666 truncate-1"><?= $grupo["descripcion"]; ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php } ?>




<div class="tab mb50">
    <div class="tabIn w300x pR20" style="vertical-align: top;">

        <div class="bGrowi bShadow3 h300 rr20 posR ofH">

            <div class="brillo"></div>

            <div class="p30 posR" style="z-index: 2;">
                <div class="t18 ff3 colorfff mb10">Mensaje de la semana</div>
                <div class="p5 t24 ff0 colorfff">
                    <?php
                        $frase = $_ZOOM->get_data("olc_frases", " AND fecha > '".date('Y-m-d')."' ORDER BY id ASC ", 0);
                        if($frase) echo $frase["frase"];
                    ?>
                </div>
            </div>

        </div>

    </div>
    <div class="tabIn pLR10">

        <div class="tab bfff bShadow3 rr20" style="overflow:hidden;">
            <div class="tabIn w250x">

                <div class="tab bGrowi h300" style="overflow: hidden;">
                    <div class="tabIn">

                        <div class="tab w200x mAUTO mb20">
                            <div class="tabIn vaT w50x"><div class="t40 colorfff"><i class="las la-calendar"></i></div></div>
                            <div class="tabIn vaT"><div class="t24 colorfff ff3">Próximos eventos</div></div>
                        </div>

                        <div class="wh150 bfff rr50 mAUTO">
                            <div class="vMM w100 h100_ p15">
                                <img src="<?= $static; ?>logos/300/<?= ($_SESSION["COMPANY"]["logo"]); ?>" alt="Logo <?= $_SESSION["COMPANY"]["nombre"]; ?>">
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="tabIn bGrowi2 pLR20">

                <?php

                    $eventos = [];

                    if($evento_lider_encuestas = $_ZOOM->get_data("grw_val_listasexternas_registros", " AND id_empresa = '".$_SESSION["COMPANY"]["id"]."' AND email = '".$_SESSION["WORKER"]["email"]."' ORDER BY id DESC ", 0)){
                        $eventos[] = [
                            "nombre"       => "El impacto del líder",
                            "categoria"    => "Encuestas",
                            "fecha_inicio" => '2024-08-26 00:00:00',
                            "fecha_fin"    => '2024-12-06 23:59:59',
                            "url"          => 'https://olcgroup.co/bancow/experiencia/'.$evento_lider_encuestas["uuid"].'/',
                            "type"         => 'event',
                        ];
                    }

                    if($grupos_miembro = $_ZOOM->get_data("grw_grupos_miembros", " AND id_empresa = '".$_SESSION["COMPANY"]["id"]."' AND es_lider = 0 AND id_trabajador = '".$_SESSION["WORKER"]["id"]."' ORDER BY id DESC ", 1)){
                        foreach ($grupos_miembro as $grupo_miembro) {
                            if($grupo = $_ZOOM->get_data("grw_grupos", " AND id_empresa = '".$_SESSION["COMPANY"]["id"]."' AND id = '".$grupo_miembro["id_grupo"]."' ORDER BY id DESC ", 0)){

                                $eventos[] = [
                                    "nombre"       => $grupo["nom_grupo"],
                                    "categoria"    => "Ranking Grupo",
                                    "fecha_inicio" => '2024-08-26 00:00:00',
                                    "fecha_fin"    => '2025-01-31 23:59:59',
                                    "url"          => 'https://olcgroup.co/bancow/ranking/'.$grupo["uuid"].'/',
                                    "type"         => 'ranking',
                                ];

                            }
                        }
                    }

                    if($eventos){

                        foreach ($eventos as $key => $evento) {

                            include 'componentes_eventos/'.$evento["type"].'.php';

                        }

                    }else{

                ?>

                    <div class="taC">
                        <img src="<?= $dominion; ?>resources/img/sin-eventos.png" alt="">
                        <div class="mt20 color666 t16 ff0">No hay eventos disponibles en este momento</div>
                    </div>

                <?php } ?>

            </div>
        </div>

    </div>

</div>



<script>$(document).ready(function() { Platform.Climate(); });</script>