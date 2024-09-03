<?php
    $access = 0;
    if($permiso = $_GROWI->GetCampos ( "olc_empresa_parametros", "beneficios, factor_calificacion", $Condicion = " id_empresa = ".$_SESSION['COMPANY']['id']." ", 1 )) $access = $permiso["beneficios"];
    if($access){
?>

<div class="bGrowi posA w100 bBS2 bCeee getH" style="top:0; left:0; z-index:3;">
    <div class="general1600">
        <div class="row align-items-end">
            <div class="col-12 col-lg-8">
                <div class="h60"></div>
                <div class="colorVerde5 t60 ff4 mb10">Beneficios</div>
                <div class="t30 colorfff ff2 mb5"><?= $_SESSION['WORKER']['nombre']; ?>, tu bienestar es nuestra prioridad.</div>
                <div class="t18 colorfff ff1 mb30">¡Explora, redime y disfruta de los beneficios que hemos preparado para ti!</div>
                <div class="row" style="margin-bottom:-40px;">
                    <div class="col-12 col-lg-4">
                        <div class="bShadow3 bfff rr15 bBene1 ofH">
                            <div class="tab p15">
                                <div class="tabIn">
                                    <div class="t16 ff3 colorGrowi mb5">Total puntos</div>
                                    <div class="t50 ff4 colorGrowi">
                                        <span>0</span>
                                        <span class="t20">Pts</span>
                                    </div>
                                </div>
                                <div class="tabIn w80x">
                                    <div class="bShadow3 bfff rr15"><img src="<?= $dominion; ?>resources/img/bene-1.png" /></div>
                                </div>
                            </div>
                            <div class="bfff p1020">
                                <div class="dIB bVerde5 colorfff p310 rr10 mR5">0 pts</div>
                                <div class="dIB">en los últimos 30 días</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="bShadow3 bfff rr15 bBene2 ofH">
                            <div class="tab p15">
                                <div class="tabIn">
                                    <div class="t16 ff3 colorGrowi mb5">Puntos redimidos</div>
                                    <div class="t50 ff4 colorGrowi">
                                        <span>0</span>
                                        <span class="t20">Pts</span>
                                    </div>
                                </div>
                                <div class="tabIn w80x">
                                    <div class="bShadow3 bfff rr15"><img src="<?= $dominion; ?>resources/img/bene-2.png" /></div>
                                </div>
                            </div>
                            <div class="bfff p1020">
                                <div class="dIB bMorado2 colorfff p310 rr10 mR5">0 pts</div>
                                <div class="dIB">en los últimos 30 días</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="bShadow3 bfff rr15 bBene3 ofH">
                            <div class="tab p15">
                                <div class="tabIn">
                                    <div class="t16 ff3 colorGrowi mb5">Beneficios aprobados</div>
                                    <div class="t50 ff4 colorGrowi">
                                        <span>0</span>
                                    </div>
                                </div>
                                <div class="tabIn w80x">
                                    <div class="bShadow3 bfff rr15"><img src="<?= $dominion; ?>resources/img/bene-3.png" /></div>
                                </div>
                            </div>
                            <div class="bfff p1020">
                                <div class="dIB b000 colorfff p310 rr10 mR5">0</div>
                                <div class="dIB">en revisión</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <img src="<?= $dominion; ?>resources/img/beneficios.png" />
            </div>
        </div>
    </div>
</div>

<div class="setH"></div>


<?php

    if($beneficios = $_GROWI->GetCampos("grw_beneficios", "uuid, id_categoria, id_tipo, nombre, descripcion, puntos, imagen", " id_empresa = ".$_SESSION['COMPANY']['id']." AND inactivo = 0 ")){

        $in = "";

        foreach(array_values(array_unique(array_column($beneficios, "id_categoria"))) as $cat){
            if($in == "") $in .= $cat;
            else          $in .= ",".$cat;
        }
        $in = "(".$in.")";

        $beneficios_cats = SetPositionArray($_GROWI->GetCampos ( "olc_beneficios_categorias", "id, uuid, nombre, icono", " id IN $in AND inactivo = 0 "), "id");

        echo '<div class="general1600 pAA50">';
        echo '
            <div class="dIB">
                <a href="#" class="tab pLR10 rr3 bVerde5 bHover t40 bShadow3">
                    <div class="tabIn rr3 t40 wh60 colorfff">
                        <div class="vMM">
                            <i class="las la-hand-holding-heart"></i>
                        </div>
                    </div>
                    <div class="tabIn ff3 t14 pR20 colorfff">Todos los beneficios</div>
                </a>
                <div style="height:15px"></div>
            </div>
        ';

        foreach($beneficios_cats as $categoria){
            include 'app_platform/components/beneficios_categoria.php';
        }

        echo '<div class="h40"></div>';

        echo '<div class="row">';
        foreach($beneficios as $beneficio){
            echo '<div class="col-12 col-lg-3 col-xl-2dot4">';
            if($beneficio["id_tipo"] == 1) include 'app_platform/components/beneficio_activo.php';
            if($beneficio["id_tipo"] == 2) include 'app_platform/components/beneficio.php';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';

    }

    }else{
?>

    <div class="bGrowi posA w100 bBS2 bCeee " style="top:0; left:0; z-index:3;">
        <div class="general1600 taC">

            <div class="h60"></div>
            <div class="h60"></div>
            <div class="colorVerde5 t60 ff4 mb30">Beneficios</div>
            <div class="t30 colorfff ff2 mb10"><?= $_SESSION['WORKER']['nombre']; ?>, tu bienestar es nuestra prioridad.</div>
            <div class="t18 colorfff ff1 mb30">Esta empresa no tiene beneficios habilitados.</div>

            <div class="">
                <img src="<?= $dominion; ?>resources/img/beneficios.png" />
            </div>

        </div>
    </div>

<?php } ?>




<!-- Modal -->
<div class="modal fade" id="GrowiModal" tabindex="-1" role="dialog" aria-labelledby="GrowiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"" role="document">
        <div class="modal-content modalion posR">

            <div class="posA wh30 rr50 bHover cP bS2 t16 color999" style="right:10px; top:10px; z-index:10" data-dismiss="modal" aria-label="Close"><div class="vMM"><i class="las la-times"></i></div></div>

            <div class="modal-body-">

                <div id="rtn-GrowiModal"></div>

            </div>

        </div>
    </div>
</div>
