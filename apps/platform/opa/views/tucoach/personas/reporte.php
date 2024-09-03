<?php
    $reporte = $_TUCOACH->get_data("grw_tuc_p2p_reportes", " AND id = $id AND eliminado = 0 ORDER BY id DESC ", 0);
    if($reporte){

        require_once('reporte_motor.php');

        if($motor === 1){

            // echo '<pre>';
            // print_r($allion);
            // echo '</pre>';

?>

    <br>
    <div class="content-body">

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card h300" style="overflow:auto;">
                    <div class="card-content collapse show">
                        <div class="card-header">
                            <h4 class="card-title">Evalúa</h4>
                        </div>
                        <div class="p20">
                            <div class="primary t16 tB mb3"><?= ($thisEvaluado["nombre"]); ?></div>
                            <div class="t16 tB mb10"><?= ($thisEvaluado["cargo"]); ?></div>
                            <div class="mb3"><?= ($thisEvaluado["identificacion"]); ?></div>
                            <div class="color999 t12 mb10">Documento</div>
                            <div class="mb3"><?= ($thisEvaluado["mail"]); ?></div>
                            <div class="color999 t12 mb10">E-mail</div>
                            <div class="secundary t16 tB mb3"><?= ($thisEmpresa["nombre"]); ?></div>
                            <div class="color999 t12">Empresa</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card h300" style="overflow:auto;">
                    <div class="card-content collapse show">
                        <div class="card-header">
                            <h4 class="card-title">Método</h4>
                        </div>
                        <div class="p20">
                            <div class="primary t16 tB mb3"><?= ($thisEvaluacion["nombre"]); ?></div>
                            <div class="color999 t12 mb15">Evaluación</div>
                            <div class="primary t16 tB mb3"><?= ($thisTest["nombre"]); ?></div>
                            <div class="color999 t12 mb15">Test</div>
                            <div class="primary t16 tB mb3">
                                <?php
                                    if($thisPerfilesAsig){
                                        foreach($thisPerfilesAsig AS $thisIDPerfil){
                                            $thisPerfil = $_TUCOACH->get_data("grw_perfiles", " AND id = ".$thisIDPerfil["id_perfil"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
                                            if($thisPerfil){
                                                echo ($thisPerfil["nombre"]);
                                                if(count($thisPerfilesAsig) > 1) echo " | ";
                                            }
                                        }
                                    }
                                ?>
                            </div>
                            <div class="color999 t12 mb15">Perfil<?php if(count($thisPerfilesAsig) > 1) echo "es"; ?></div>
                            <div class="primary t16 tB mb3"><?= ($thisGrupoPreguntas["nombre"]); ?></div>
                            <div class="color999 t12">Modalidad de respuestas</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card h300" style="overflow:auto;">
                    <div class="card-content collapse show">
                        <div class="card-header">
                            <div id="rtn_list" class="fR taR"></div>
                            <h4 class="card-title">Asignaciones por Roles</h4>
                        </div>
                        <?php
                            if($thisRolesAsig){
                                foreach($thisRolesAsig AS $rolid){
                                    $c1  = 0;
                                    $c2  = 0;
                                    $rol = $_TUCOACH->get_data("grw_tuc_roles", " AND id = ".$rolid["id_rol"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
                                    if($rol){
                                        foreach($thisAsignaciones AS $thisAsignacion){
                                            if($thisAsignacion["id_rol"] == $rol["id"]){
                                                $c1++;
                                                if($thisAsignacion["realizado"]){
                                                    $c2++;
                                                }
                                            }
                                        }
                                    }
                                    echo '<div class="tab" style="padding:11px 0;">';
                                    echo '<div class="tabIn w50x"><div class="rr50 wh20 mAUTO" style="background-color:'.($rol["color"]).';"></div></div>';
                                    echo '<div class="tabIn tB">'.($rol["nombre"]).'</div>';
                                    echo '<div class="tabIn tB taR">'.$c2."/".$c1.'</div>';
                                    echo '<div class="tabIn taR w80x pR20">'.($rol["valor"]).'%</div>';

                                    echo '</div>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="card p30">
            <div class="row align-items-center">
                <div class="col-12 col-md-1 p0">
                    <div class="t30 tB taR"><?= round($resultadoFinal, 2); ?></div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="primary t16 tB mb3">Calificación global</div>
                    <div class="color666 t14">Mínimo requerido: <?= ($thisEvaluacion["nivel_minimo"]); ?></div>
                </div>
                <div class="col-12 col-md-2 p0">
                <a href="../reporte/?ion=<?=$id;?>" target="_blank" class="btn btn-primary btn-sm"><i class="la la-file-pdf-o t16"></i> Generar PDF</a>
                </div>
                <div class="col-12 col-md-5 taR">
                    <?php
                        foreach($rolesVale AS $rolesVal){
                            echo ' <div class="dIB colorfff t12 p510 rr20" style="background-color:'.($rolesVal["color"]).';">';
                            echo ($rolesVal["nombre"]." - ".round($rolesVal["valorFinal"], 2))."%";
                            echo '</div> ';
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="pLR30">
            <ul class="nav nav-tabs mb-1" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active primary tB tU t16 p20" id="tab_categorias" data-toggle="tab" href="#tab_categorias_a" role="tab" aria-controls="tab_categorias_a" aria-selected="true" style="padding:10px 20px !important; border:0">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link primary tB tU t16" id="tab_competencias" data-toggle="tab" href="#tab_competencias_a" role="tab" aria-controls="tab_competencias_a" aria-selected="false" style="padding:10px 20px !important;">Competencias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link primary tB tU t16" id="tab_comportamientos" data-toggle="tab" href="#tab_comportamientos_a" role="tab" aria-controls="tab_comportamientos_a" aria-selected="false" style="padding:10px 20px !important;">Comportamientos</a>
                </li>
            </ul>
        </div>


        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab_categorias_a" role="tabpanel" aria-labelledby="tab_categorias">
                <div class="card p40 p20_oS">
                    <?php include "reporte_gra1.php";?>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_competencias_a" role="tabpanel" aria-labelledby="tab_competencias">
                <div class="card p40 p20_oS">
                    <?php include "reporte_gra2.php";?>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_comportamientos_a" role="tabpanel" aria-labelledby="tab_comportamientos">
                <div class="card p40 p20_oS">
                  <?php include "reporte_gra3.php";?>
                </div>
            </div>
        </div>


        <pre><?php //print_r($allion); ?></pre>
        <pre><?php //print_r($rolesVale); ?></pre>


<?php
        } else echo "<div class='card taC pAA50 t30'>".$motor."</div>";
    } else echo "<div class='card taC pAA50 t30'>"."ERROR: reporte que busca no existe."."</div>";
?>