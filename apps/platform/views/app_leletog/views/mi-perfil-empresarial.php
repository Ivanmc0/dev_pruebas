<div class="bfff p40 p20_oS bBS1 mb20">
    <div class="ff3 t18 colorVerde mb5">Mi Perfil Empresarial</div>
</div>

<div class="general pAA30">

    <?php /*if($mi_perfil && $mi_cargo && isset($mi_cargo["jefe"]) && isset($mi_cargo["cargo"])){*/ ?>
        <!-- <div class="tab bShadow2 bVerde rr60 mb50 mb30_oS">
            <div class="tabIn w80x taC t24 colorfff"><i class="fas fa-check-circle"></i></div>
            <div class="tabIn p20 p15_oS" style="padding-left:0;">
                <div class="t18 ff2 colorfff mb5">Tu perfil empresarial está completo</div>
                <div class="coloreee">Puedes actualizarlo cuando gustes.</div>
            </div>
        </div> -->
    <?php /*} else { */?>
        <!-- <div class="tab bShadow2 rr60 mb50 mb30_oS" style="background-color:#ffe8e8;">
            <div class="tabIn w80x taC t24 colorRojo"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="tabIn p20 p15_oS" style="padding-left:0;">
                <div class="t18 ff2 colorRojo mb5">Debes completar tus datos para participar en las actividades</div>
                <div class="color666">Te invitamos a completar la información requerida en Mis datos y Mi Posición Organizacional.</div>
            </div>
        </div> -->
    <?php /*} */?>


    <div class="max700 mAUTO">

        <div class="t18 ff2 color999 mb20">Mis datos</div>
        <?php
            echo '<div class="bShadow2 bfff p20 mb50 mb30_oS">';
            if($mi_perfil){
                foreach ($mi_perfil as $key => $value) {
                    echo '
                        <div class="tab bBS1 bCeee " style="margin-top:-1px">
                            <div class="tabIn p10 ff2">'.$value["pregunta"].'</div>
                            <div class="tabIn p10 taR">'.$value["respuesta"].'</div>
                        </div>
                    ';
                }
            }else{
                echo '
                  <!--  <div class="taC t40 color999 mb30"><i class="fas fa-hourglass-half" style="color:#ff7878;"></i></div>
                    <div class="max400 mAUTO taC t18 ff2 colorVerde mb10" style="color:#ff7878;">Los datos de tu Perfil Empresarial se encuentran incompletos.</div> 
                -->
                    <div class="max400 mAUTO taC t14 ff1 color666 mb20">Te invitamos a completar el diligenciamiento de tu perfil para continuar con las actividades asignadas.</div>
                ';
            }
            echo '
                <div class="taC mt20">
                    <a href="'.$dominion.'completar-perfil/" class="bVerde ff2 colorfff dIB p1020 bHover rr20">Actualizar mis datos</a>
                </div>
            ';
            echo '</div>';
        ?>


        <div class="t18 ff2 color999 mb20">Mi Posición Organizacional</div>
        <?php
            echo '<div class="bShadow2 bfff p20 mb20">';
            if($mi_cargo && isset($mi_cargo["jefe"]) && isset($mi_cargo["cargo"])){
                echo '
                    <div class="tab bBS1 bCeee " style="margin-top:-1px">
                        <div class="tabIn p10 ff2">Mi cargo</div>
                        <div class="tabIn p10 taR">
                            <div class="">'.$mi_cargo["cargo"]["nombre"].'</div>
                        </div>
                    </div>
                    <div class="tab bBS1 bCeee " style="margin-top:-1px">
                        <div class="tabIn p10 ff2">Mi jefe directo</div>
                        <div class="tabIn p10 taR">
                            <div class="mb3">'.($mi_cargo["jefe"]["nombre"]).'</div>
                            <div class="t12 color999">'.($mi_cargo["jefe"]["cargo"]).'</div>
                        </div>
                    </div>
                ';
            }else{
                echo '
                <!--  <div class="taC t40 color999 mb30"><i class="fas fa-hourglass-half" style="color:#ff7878;"></i></div>
                    <div class="max400 mAUTO taC t18 ff2 colorVerde mb10" style="color:#ff7878;">Los datos de tu Posición Organizacional se encuentran incompletos.</div>
                    -->
                    <div class="max400 mAUTO taC t14 ff1 color666 mb20">Te invitamos a completar el diligenciamiento de tu jefe y cargo para continuar con las actividades asignadas.</div>
                ';
            }
            echo '
                <div class="taC mt20">
                    <a href="'.$dominion.'completar-jefe/" class="bVerde ff2 colorfff dIB p1020 bHover rr20">Actualizar mis datos</a>
                </div>
            ';
            echo '</div>';
        ?>

    </div>

</div>