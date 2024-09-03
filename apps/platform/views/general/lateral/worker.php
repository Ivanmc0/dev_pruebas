<?php
    $sigla  = $_SESSION['WORKER']["sigla"]
?>

<div class="bGray pAA60 pAA50_oS">

    <div class="pLR30 pLR20_oS">

        <div class="tab mb50 mb30_oS">
            <div class="tabIn w80x w50x_oS">
                <div class="wh80 wh50_os rr50 bMorado colorfff ff3 t30"><div class="vMM w100 h100_"><?= $sigla; ?></div></div>
            </div>
            <div class="tabIn pL20 pLR10_oS">
                <div class="color000 ff3 t20 mb3">Hola, <?= $_SESSION['WORKER']['nombre']; ?></div>
                <div class="color666 ff1 t16 mb10"><?php if($_SESSION['WORKER']["cargo"] != 0) echo $_SESSION['WORKER']["cargo"]; else echo '<i class="colorRojo">Sin cargo</i>'; ?></div>
                <div class="color333 ff4 t14"><?= ($_SESSION['COMPANY']["nombre"]); ?></div>
            </div>
        </div>

        <?php

            echo '<div class="bfff rr20 p10 mb30 mb20_oS">';
            echo '<div class="ff3 color000 t18 p10 p5_oS mb5">Mis Roles</div>';

            if($app == 'platform'){
                if(isset($geton[0]) && $geton[0] != 'panel-control'){
                    $urltem2    = '<div class="ff1 color000"><i class="las la-check-circle t16"></i> Rol activo</div>';
                    $resaltador = 'resaltador';
                } else {
                    $urltem2    = '<a href="'.$_SESSION["COMPANY"]["GROWI"].'tablero/" class="dB p515 ff2 colorMorado2 t14 bS2 rr20 bHover cP">Mi tablero</a>';
                    $resaltador = '';
                }
            }else{
                $urltem2    = '<a href="'.$_SESSION["COMPANY"]["GROWI"].'tablero/" class="dB p515 ff2 colorMorado2 t14 bS2 rr20 bHover cP">Mi tablero</a>';
                $resaltador = '';
            }

            echo '<div class="tab p15 rr20 bGray mb5 '.$resaltador.'">';
            echo '<div class="tabIn w40x"><div class="wh40 rr50 bMorado colorfff ff2 t14"><div class="vMM w100 h100_">'.$sigla.'</div></div></div>';
            echo '<div class="tabIn pLR10">';
            echo '<div class="color000 ff3 t16 mb3">'.($_SESSION['WORKER']["nombre"]).' </div>';
            echo '<div class="color666 ff2 t14">Colaborador</div>';
            echo '</div>';
            echo '<div class="tabIn w100x taC">'.$urltem2.'</div>';
            echo '</div>';

            if(isset($_SESSION["WORKER"]["admin"]) && $_SESSION["WORKER"]["admin"] == 1 && isset($_SESSION["WORKER"]["roles"])){
                foreach ($_SESSION["WORKER"]["roles"] as $key => $rol) {

                    if(isset($geton[0]) && $geton[0] == 'panel-control' && isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"]["id"] == $rol["id"] ){
                        $urltem2    = '<div class="ff1 color000"><i class="las la-check-circle t16"></i> Rol activo</div>';
                        $resaltador = 'resaltador';
                    } else {
                        $urltem2    = '<div class="p515 ff2 colorMorado2 t14 bS2 rr20 bHover cP" onclick="Ion.viewPain(\''.$rol["uuid"].'\')">Ingresar</div>';
                        $resaltador = '';
                    }

                    echo '<div class="tab p15 rr20 bGray mb5 '.$resaltador.'">';
                    echo '<div class="tabIn w40x"><div class="wh40 rr50 bMorado colorfff ff2 t14"><div class="vMM w100 h100_">'.$sigla.'</div></div></div>';
                    echo '<div class="tabIn pLR10">';
                    echo '<div class="color000 ff3 t16 mb3">'.($_SESSION['WORKER']["nombre"]).' </div>';
                    echo '<div class="color666 ff2 t14">'.($rol["nombre"]).'</div>';
                    echo '</div>';
                    echo '<div class="tabIn w100x taC">'.$urltem2.'</div>';
                    echo '</div>';
                }
            }
            echo '</div>';


        ?>


        <a href="<?= $_SESSION["COMPANY"]["GROWI"]; ?>perfil/" class="tab p10 bHover2">
            <div class="tabIn w40x color000 t30 taC"><i class="las la-address-card"></i></div>
            <div class="tabIn pL10"><div class="color666 ff4 t16">Información Personal</div></div>
        </a>

        <a href="<?= $_SESSION["COMPANY"]["GROWI"]; ?>beneficios/" class="tab p10 bHover2">
            <div class="tabIn w40x color000 t30 taC"><i class="las la-ticket-alt"></i></div>
            <div class="tabIn pL10"><div class="color666 ff4 t16">Beneficios</div></div>
        </a>

        <a href="<?= $_SESSION["COMPANY"]["GROWI"]; ?>reconocimientos/" class="tab p10 bHover2">
            <div class="tabIn w40x color000 t30 taC"><i class="las la-certificate"></i></div>
            <div class="tabIn pL10"><div class="color666 ff4 t16">Reconocimientos</div></div>
        </a>

        <a href="#" onclick="Ion.logOut()" class="tab p10 bHover2">
            <div class="tabIn w40x color000 t30 taC"><i class="las la-sign-out-alt"></i></div>
            <div class="tabIn pL10"><div class="color666 ff4 t16 rtn_logout">Cerrar sesión</div></div>
        </a>

    </div>
</div>