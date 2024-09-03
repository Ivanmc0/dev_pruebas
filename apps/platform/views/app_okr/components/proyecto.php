<div onclick="Ion.viewProject(<?= $asignacion['id']; ?>)" class="p20 bGray rr10 bS2 bHover2 cP">

    <div class="tab p5 rr40 bOkr2">
        <div class="tabIn w60x"><div class="wh50 bS2 bCfff bOkr rr50 colorfff ff4 t16"><div class="vMM">R</div></div></div>
        <div class="tabIn">
            <div class="t12 ff0 color666 mb3">Responsable</div>
            <div class="colorGrowi t16 ff4 mb3"><?= $asignacion["responsable"]["nombre"]; ?></div>
        </div>

    </div>

    <div class="h120 p1020">
        <div class="tabAll">
            <div class="tabIn">
                <div class="ff4 t18 colorGrowi mb5"><?= ($asignacion["nombre"]); ?></div>
                <div class="ff1 t14 color666"><?= ($asignacion["descripcion"]); ?></div>
            </div>
        </div>
    </div>

    <!-- <div class="bS1 bfff p10 rr10 mb10">
        <div class="tab bfff rr5 mb10">
            <div class="tabIn w30x t20"><i class="las la-list-alt"></i></div>
            <div class="tabIn"><div class="t14 colorGrowi ff3">Balance total</div></div>
            <div class="tabIn taR pLR10"><div class="t12 t16 ff4 colorGrowi ">77.1%</div></div>
        </div>
        <div class="beee rr5 ovH">
            <div class="w70 rr5 p5 bVerde"></div>
        </div>
    </div> -->

    <!-- <div class="bS1 bfff p10 rr10">
        <div class="row align-items-center">
            <div class="col-5">
                <div class="ff3 t14 color999 mb5">Inicia</div>
                <div class="ff2 t14">
                    <?php
                        $desde = $_TUCOACH->get_data("olc_semanas", " AND id = ".$asignacion["id_semana_desde"]." AND inactivo = 0 AND eliminado = 0 ", 0);
                        if($desde){
                            echo '<div class="color333 ff3">'.("Sem. ".$desde["semana"]).' de '.$desde["ano"].'</div>';
                        }
                    ?>
                    <?php //DateFront($actividad['periodo']['desde'], 1); ?>
                </div>
            </div>
            <div class="col-2 taC t24"><i class="las la-chevron-circle-right"></i></div>
            <div class="col-5">
                <div class="ff3 t14 color999 mb5">Finaliza</div>
                <div class="ff2 t14">
                    <?php
                        $hasta = $_TUCOACH->get_data("olc_semanas", " AND id = ".$asignacion["id_semana_hasta"]." AND inactivo = 0 AND eliminado = 0 ", 0);
                        if($hasta){
                            echo '<div class="color333 ff3">'.("Sem. ".$hasta["semana"]).' de '.$hasta["ano"].'</div>';
                        }
                    ?>
                    <?php // DateFront( $actividad['periodo']['hasta'], 1 ); ?>
                </div>
            </div>
        </div>
    </div> -->

    <div class="bS1 bfff p10 rr10 mb10">
        <div class="tab">
            <div class="tabIn t24 w40x colorMorado2"><i class="las la-flag"></i></div>
            <div class="tabIn"><div class="colorGrowi t14 ff2">Finaliza: <?= DateFront($asignacion['periodo']['hasta']); ?></div></div>
            <div class="tabIn taR">
                <div class="btn-1 btn-zs">
                    <i class="las la-play left"></i>
                    <span class="t14 ff3 colorfff">Acceder</span>
                </div>
            </div>
        </div>
    </div>

</div>