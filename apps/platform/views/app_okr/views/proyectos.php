

<?php

    include $roution."views/components/tabs-dashboards.php";

?>

<div id="rtn-viewProject"></div>

<!--
<div class="posR">

    <div class="tabsGrowi posR w90" style="z-index:5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link posR active ff3" id="asignation-tab" data-toggle="tab" href="#asignation" role="tab" aria-controls="asignation" aria-selected="true">
                    <div class="mask posA h10 w100 bfff" style="bottom:-8px;left:0"></div>
                    Mis pendientes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link posR ff3" id="reportion-tab" data-toggle="tab" href="#reportion" role="tab" aria-controls="reportion" aria-selected="false">
                    <div class="mask posA h10 w100 bfff" style="bottom:-8px;left:0"></div>
                    Reportes
                </a>
            </li>
        </ul>
    </div>

    <div class="bShadow3 bfff bS1 bCeee p30" style="margin-top:-1px; border-radius:0 15px 15px 15px">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="asignation" role="tabpanel" aria-labelledby="asignation-tab">

                <div class="tab mb30">
                    <div class="tabIn">
                        <div class="t18 pLR20 ff3 colorGrowi">Listado de Proyectos</div>
                    </div>
                    <div class="tabIn">
                        <div class="tabsGrowIn posR taR" style="z-index:5">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link posR active ff3" id="encurso-tab" data-toggle="tab" href="#encurso" role="tab" aria-controls="encurso" aria-selected="true">
                                        <i class="las la-hourglass-half"></i>
                                        En curso
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link posR ff3" id="finalizado-tab" data-toggle="tab" href="#finalizado" role="tab" aria-controls="finalizado" aria-selected="false">
                                        Finalizados
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="encurso" role="tabpanel" aria-labelledby="encurso-tab">

                        <?php
                            // $PeriodoInicial = '2024-01-01 00:00:00';
                            // $PeriodoFinal   = '2024-12-31 23:59:59';
                            // $projects = $_WORKERS->GetProcess('PYT', $_SESSION["COMPANY"]["id"], $_SESSION["WORKER"]["id"], $PeriodoInicial,  $PeriodoFinal );

                            // if($projects){
                            //     $projects = $projects["pyts"];
                            //     echo '<div class="row">';
                            //     foreach($projects AS $project){
                            //         $responsable = $_TUCOACH->get_data("zoom_users", " AND id = ".$project["id_responsable"]." AND inactivo = 0 AND eliminado = 0 ", 0);
                            //         echo '<div class="col-12 col-md-6 col-lg-4 col-xl-4">';
                            //         include $roution."views/app_okr/components/PYT.php";
                            //         echo '</div>';
                            //     }
                            //     echo '</div>';
                            // }else{
                            //     echo '<div class="colorRojo t16 ff3">No hay proyectos creados</div>';
                            // }
                        ?>

                    </div>
                    <div class="tab-pane fade" id="finalizado" role="tabpanel" aria-labelledby="finalizado-tab">

                        <?php include $roution."views/general/components/empty.php"; ?>

                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="reportion" role="tabpanel" aria-labelledby="reportion-tab">

                <?php include $roution."views/general/components/empty.php"; ?>

            </div>
        </div>
    </div>

</div>

-->
