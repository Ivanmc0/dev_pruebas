<?php
    $tablus = $access_model["tabla"];
    $edit = false;

    $exp = explode("-", $id);
    $id_grupo = $exp[0];
    $id_sesion = $exp[1];

    $grupo        	= $_ZOOM->get_data("w_grupos", " AND id_proyecto = 3 AND id = '".$id_grupo."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
    $alumnos        = $_ZOOM->get_data("w_alumnos", " AND id_proyecto = 3 AND grupo = '".$grupo["nombre"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1);
    $calificaciones = $_ZOOM->order_array_by($_ZOOM->get_data("w_soluciones", " AND id_proyecto = 3 AND id_sesion = ".$id_sesion." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1), "id_alumno");

    // echo '<pre>';
    // print_r($calificaciones);
    // echo '</pre>';
?>

<div class="content-body">


    <form action="w/accion-soluciones-2024" id="formion" name="formion" method="post" class="form-horizontal zoom_form dB posR">


    <div class="card text-center bfff w250x p1020 bShadow2  bS1 rr3 m0" style="position:fixed; bottom:55px; z-index:1; margin-left:-35px;">
    <!-- <div class=""></div> -->
        <button class="btn btn-teal" type="submit"><i class="la la-save t14"></i> &nbsp; Guardar información</button>
    </div>



        <?php
            foreach ($alumnos as $key => $alumno) {
                if(isset($calificaciones[$alumno["id"]])){
                    $calificacion = $calificaciones[$alumno["id"]];
        ?>

            <div class="card bS1">
                <div class="card-content collapse show">
                    <div class="card-header beee bBS1 p10">
                        <h5 class="card-title">
                            <?= ($alumno["nombre"]); ?>
                            <small>
                            | Grupo: <?= ($alumno["grupo"]); ?>
                            - Sesión: <?= $id_sesion-10; ?>
                            </small>
                        </h4>
                    </div>
                    <div class="card-body p510">

                        <div class="row mb10">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <label class="control-label">Participación</label>
                                        <select class="form-control form-group-margin" id="asis" name="<?= $calificacion["id"]; ?>[asis]">
                                            <option value="0" <?php if($calificacion["asis"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["asis"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($calificacion["asis"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($calificacion["asis"] == 3) echo "selected"; ?>>3</option>
                                            <option value="4" <?php if($calificacion["asis"] == 4) echo "selected"; ?>>4</option>
                                            <option value="5" <?php if($calificacion["asis"] == 5) echo "selected"; ?>>5</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">Evaluación</label>
                                        <select class="form-control form-group-margin" id="eval" name="<?= $calificacion["id"]; ?>[eval]">
                                            <option value="0" <?php if($calificacion["eval"] == 0) echo "selected"; ?>>No</option>
                                            <option value="3" <?php if($calificacion["eval"] == 3) echo "selected"; ?>>Si</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">Reto 1</label>
                                        <select class="form-control form-group-margin" id="reto1" name="<?= $calificacion["id"]; ?>[reto1]">
                                            <option value="0" <?php if($calificacion["reto1"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["reto1"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($calificacion["reto1"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($calificacion["reto1"] == 3) echo "selected"; ?>>3</option>
                                            <option value="4" <?php if($calificacion["reto1"] == 4) echo "selected"; ?>>4</option>
                                            <option value="5" <?php if($calificacion["reto1"] == 5) echo "selected"; ?>>5</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">AH. Envío</label>
                                        <select class="form-control form-group-margin ah_envio" idcalificacion="<?= $calificacion["id"]; ?>" id="ah_envio-<?= $calificacion["id"]; ?>" name="<?= $calificacion["id"]; ?>[ah_envio]">
                                            <option value="0" <?php if($calificacion["ah_envio"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["ah_envio"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($calificacion["ah_envio"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($calificacion["ah_envio"] == 3) echo "selected"; ?>>3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">

                                    <div class="col-3">
                                        <label class="control-label">AH. Logro</label>
                                        <select class="form-control form-group-margin" id="ah_logro-<?= $calificacion["id"]; ?>" name="<?= $calificacion["id"]; ?>[ah_logro]">
                                            <option value="0" <?php if($calificacion["ah_logro"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["ah_logro"] == 1) echo "selected"; ?>>Si</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">Desafío</label>
                                        <select class="form-control form-group-margin" id="desafio" name="<?= $calificacion["id"]; ?>[desafio]">
                                            <option value="0" <?php if($calificacion["desafio"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["desafio"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($calificacion["desafio"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($calificacion["desafio"] == 3) echo "selected"; ?>>3</option>
                                            <option value="4" <?php if($calificacion["desafio"] == 4) echo "selected"; ?>>4</option>
                                            <option value="5" <?php if($calificacion["desafio"] == 5) echo "selected"; ?>>5</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">Bonus Eficacia</label>
                                        <select class="form-control form-group-margin" id="ah_bonus" name="<?= $calificacion["id"]; ?>[ah_bonus]">
                                            <option value="0" <?php if($calificacion["ah_bonus"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["ah_bonus"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($calificacion["ah_bonus"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($calificacion["ah_bonus"] == 3) echo "selected"; ?>>3</option>
                                            <option value="4" <?php if($calificacion["ah_bonus"] == 4) echo "selected"; ?>>4</option>
                                            <option value="5" <?php if($calificacion["ah_bonus"] == 5) echo "selected"; ?>>5</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">Medalla</label>
                                        <select class="form-control form-group-margin" id="insignia" name="<?= $calificacion["id"]; ?>[insignia]">
                                            <option value="0" <?php if($calificacion["insignia"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["insignia"] == 1) echo "selected"; ?>>Oro</option>
                                            <option value="2" <?php if($calificacion["insignia"] == 2) echo "selected"; ?>>Plata</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
                }
            }
        ?>

        <div id="rtn-formion" class="taC mb20"></div>

        <?php //include $roution."views/botones_config.php"; ?>

        <div class="h80"></div>

    </form>

</div>