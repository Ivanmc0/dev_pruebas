<?php

    $PeriodoInicial = '2024-01-01 00:00:00';
    $PeriodoFinal   = '2024-12-31 23:59:59';
    $asignaciones = $_WORKERS->GetProcess('VAL', $_SESSION['COMPANY']['id'], $_SESSION['WORKER']['id'], $PeriodoInicial, $PeriodoFinal);

    $setTabs      = [
        'tab'      => 'Mis Encuestas',
        'folder'   => 'app_valora',
        'cols'     => 'col-12 col-xl-4 mb30 mb20_oS',
        'file'     => 'encuesta.php',
        'colsR'    => 'col-12 col-xl-6 mb30 mb20_oS',
        'fileR'    => 'proyecto-reporte.php',
        'function' => 'ListadoReportesValora',
    ];

?>

<div class="row">

    <div class="col-12 col-lg-4">
        <div class="bfff rr15 bShadow3" style="position:sticky; top:30px;">
            <?php include $roution."views/general/components/head-$app.php"; ?>
        </div>
    </div>

    <div class="col-12 col-lg-8">

        <?php include $roution."views/components/tabs-dashboards.php"; ?>

    </div>

</div>