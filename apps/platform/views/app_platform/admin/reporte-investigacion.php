<?php
    if($mud = $_PLATFORM->PermissionValidationModel ($app, $geton[3], true)){
        if($investigacion = $_GROWI->GET("VALORA", "ReportInvestigacion", " AND INV.uuid = '".$geton[4]."' ", ["empresa" => "INV.id_empresa"], true)){
?>



<div class="bVerde4 posA w100 bBS2 bCeee" style="top:0; left:0">
    <div class="general1600">
        <div class="tab pAA30">
            <div class="tabIn w50x">
                <div class="" onclick="window.history.back()">
                    <div class="wh50 rr50 t30 bHover2"><div class="vMM rr50"><i class="las la-arrow-left"></i></div></div>
                </div>
            </div>
            <div class="tabIn w70x pLR10">
                <div class="bVerde2 colorfff wh50 rr50 t30"><div class="vMM rr50"><i class="las la-file-invoice"></i></div></div>
            </div>
            <div class="tabIn pL10">
                <div class="t30 color000 ff1">Balances y Reportes</div>
            </div>
        </div>
    </div>
</div>

<div class="h100 h50_oS"></div>


<div class="general">


    <div class="tab bBS1 bCeee pAA20 mb30">
        <div class="tabIn">
            <div class="t14 ff1 color666 mb5">Reporte de la Investigación</div>
            <div class="t30 ff3 colorGrowi mb5"><?= $investigacion['nombre']; ?></div>
            <div class="t18 ff1 color999"><?= $investigacion['descripcion']; ?></div>
        </div>
    </div>


    <div class="row mb50">

        <div class="col-md-4">
            <div class="tab h200 bReport1 p30 rr15">
                <div class="tabIn">

                    <div class="tab mb20">
                        <div class="tabIn">
                            <div class="t16 color999 ff3 mb10">Investigación</div>
                            <div class="t24 ff4 colorGrowi truncate-1"><?= $investigacion['nombre']; ?></div>
                        </div>
                        <div class="tabIn taR"><img src="<?= $dominion; ?>resources/img/report-1.png" class="rr10"></div>
                    </div>

                    <div class="t16 ff2 colorGrowi truncate-1 mb5"><span class="ff1 color666">Inicio.</span> <?= dateFront($investigacion['fecha_inicio']); ?> &nbsp; <span class="ff1 color666">Fin.</span> <?= dateFront($investigacion['fecha_fin']); ?></div>
                    <div class="t16 ff2 colorGrowi truncate-1 mb5"><span class="ff1 color666">Valoracion.</span> <?= $investigacion['valoracion']['nombre']; ?></div>
                    <div class="t16 ff2 colorGrowi truncate-1"><span class="ff1 color666">Evento.</span> <?= $investigacion['valoracion']['nombre']; ?></div>


                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="tab h200 bReport2 p30 rr15">
                <div class="tabIn">

                    <?php if(isset($investigacion['lista'])){ ?>

                        <div class="tab mb20">
                            <div class="tabIn">
                                <div class="t16 color999 ff3 mb10">Listado de <?= $investigacion['publico']; ?></div>
                                <div class="t24 ff4 colorGrowi truncate-1"><?= $investigacion['lista']['nombre']; ?></div>
                            </div>
                            <div class="tabIn taR"><img src="<?= $dominion; ?>resources/img/report-2.png" class="rr10"></div>
                        </div>

                        <div class="t16 ff2 colorGrowi truncate-1"><span class="ff1 color666">Tipo.</span> <?= $investigacion['publico']; ?></div>

                    <?php }else{ $url = $apps['valora']['url_'.$_ENV['ENV']].'a/'.$investigacion['uuid'].'/'; ?>

                        <div class="tab mb10">
                            <div class="tabIn">
                                <div class="t16 color999 ff3 mb10">Tipo</div>
                                <div class="t24 ff4 colorGrowi truncate-1"><?= $investigacion['publico']; ?></div>
                            </div>
                            <div class="tabIn taR"><img src="<?= $dominion; ?>resources/img/report-2.png" class="rr10"></div>
                        </div>

                        <div class="t16 ff2 colorGrowi mb10"><span class="ff1 color666">URL.</span> <?= $url; ?></div>

                        <a href="<?= $url; ?>" target="_blank" class="bMorado2 colorfff rr20 t14 p515 dIB bHover">
                            <i class="las la-external-link-alt"></i> Abrir en nueva pestaña
                        </a>
                    <?php } ?>

                    <!-- <div class="tab">
                        <div class="tabIn w50x">
                            <div class="bfff p510 bShadow3 rr10 colorAzul5 ff4 t18 taC">0%</div>
                        </div>
                        <div class="tabIn t14 ff3 color666 pL10">de toda la empresa</div>
                    </div> -->

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="tab h200 bReport3 p30 rr15">
                <div class="tabIn">

                    <div class="tab mb20">
                        <div class="tabIn">
                            <div class="t16 color999 ff3 mb10">Encuesta</div>
                            <div class="t24 ff4 colorGrowi truncate-1"><?= $investigacion['encuesta']['nombre']; ?></div>
                        </div>
                        <div class="tabIn taR"><img src="<?= $dominion; ?>resources/img/report-3.png" class="rr10"></div>
                    </div>

                    <div class="t16 ff2 colorGrowi truncate-1"><span class="ff1 color666">Tipo.</span> <?= $investigacion['encuesta']['tipo']; ?></div>


                </div>
            </div>
        </div>

    </div>


    <?php
        if($investigacion['id_publico'] != 1)   include "reporte-investigacion-listado.php";
        else                                    include "reporte-investigacion-anonima.php";
    ?>


<?php
        } else {
            echo '<div class="p50 taC t30 ff0 tU">No se encontró la Investigación solicitada.</div>';
            echo '<script>setTimeout(function(){ history.back(); }, 2000);</script>';
        }
    } else  echo '<div class="p50 taC t30 ff0 tU">No posee permisos para cargar esta sección</div>';
?>