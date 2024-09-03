<?php
    $asignaciones = $_WORKERS->MyDashBoardTuCoach( $_SESSION['WORKER']['id']);
    $setTabs      = [
        'tab'      => 'Mis Estudios',
        'folder'   => 'app_tucoach',
        'cols'     => 'col-12 col-xl-12 mb30 mb20_oS',
        'file'     => 'estudio.php',
        'colsR'    => 'col-12 col-xl-12 mb30 mb20_oS',
        'fileR'    => 'estudio-reporte.php',
        'function' => 'ListadoReportesTuCoach',
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