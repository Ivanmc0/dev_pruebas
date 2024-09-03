<div class="posR">

    <div class="tabsGrowi posR" style="z-index:5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link posR active ff3" id="asignation-tab" data-toggle="tab" href="#asignation" role="tab" aria-controls="asignation" aria-selected="true">
                    <?= $setTabs['tab']; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link posR ff3" id="reportion-tab" data-toggle="tab" href="#reportion" role="tab" aria-controls="reportion" aria-selected="false">
                    Balances y Reportes
                </a>
            </li>
        </ul>
    </div>

    <div class="posR">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="asignation" role="tabpanel" aria-labelledby="asignation-tab">

                <div class="tab bfff p1530 mb30">
                    <div class="tabIn">
                        <div class="t16 pR20 ff2 colorGrowi">Listado de asignaciones</div>
                    </div>
                    <div class="tabIn">
                        <div class="tabsGrowIn posR taR" style="z-index:5">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link posR active ff3" id="encurso-tab" data-toggle="tab" href="#encurso" role="tab" aria-controls="encurso" aria-selected="true">
                                        <i class="las la-hourglass-half t16"></i>
                                        En curso
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link posR ff3" id="finalizado-tab" data-toggle="tab" href="#finalizado" role="tab" aria-controls="finalizado" aria-selected="false">
                                        <i class="las la-calendar-check t16"></i>
                                        Finalizadas
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="encurso" role="tabpanel" aria-labelledby="encurso-tab">
                        <?php
                            if ($asignaciones && !empty($asignaciones['encurso'])) {
                                echo '<div class="row">';
                                foreach ($asignaciones['encurso'] as $asignacion ) {
                                    echo '<div class="'.$setTabs['cols'].'">';
                                    include $roution."views/".$setTabs['folder']."/components/".$setTabs['file'];
                                    echo '</div>';
                                }
                                echo '</div>';
                            }else{
                                if(isset($asignaciones['historial']) && $asignaciones['historial']) include $roution."views/general/components/empty-al-dia.php";
                                else include $roution."views/general/components/empty-sin-historial.php";
                            }
                        ?>
                    </div>
                    <div class="tab-pane fade" id="finalizado" role="tabpanel" aria-labelledby="finalizado-tab">
                        <?php
                            if ($asignaciones && !empty($asignaciones['finalizados'])) {
                                foreach ($asignaciones['finalizados'] as $asignacion ) {
                                    include $roution."views/".$setTabs['folder']."/components/".$setTabs['file'];
                                }
                            }else{
                                include $roution."views/general/components/empty-sin-participaciones.php";
                            }
                        ?>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="reportion" role="tabpanel" aria-labelledby="reportion-tab">
                <div class="pAA30">

                    <?php
                        $function = $setTabs['function'];
                        if($reportes = $_WORKERS->$function( $_SESSION['WORKER']['id'] )){

                            echo '<div class="row">';
                            foreach ($reportes['encurso'] as $reporte ) {
                                echo '<div class="'.$setTabs['colsR'].'">';
                                include $roution."views/".$setTabs['folder']."/components/".$setTabs['fileR'];
                                echo '</div>';
                            }
                            echo '</div>';

                        }else{
                            include $roution."views/general/components/empty-sin-reportes.php";
                        }

                    ?>

                </div>
            </div>
        </div>
    </div>

</div>