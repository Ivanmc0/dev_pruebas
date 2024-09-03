<?php
    $tablus = $access_model["tabla"];
    $edit = false;

    $exp = explode("-", $id);
    $id_grupo = $exp[0];
    $id_sesion = $exp[1];

    $calificaciones = $_ZOOM->get_data("w_soluciones", " AND id_grupo = ".$id_grupo." AND id_sesion = ".$id_sesion." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
    $alumnos        = $_ZOOM->order_id_array($_ZOOM->get_data("w_alumnos", " AND grupo = ".$id_grupo." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1));

    // echo '<pre>';
    // print_r($alumnos);
    // echo '</pre>';
?>

<div class="content-body">

    <form action="w/accion-soluciones" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php
            foreach ($calificaciones as $key => $calificacion) {
                if(isset($alumnos[$calificacion["id_alumno"]])){
        ?>

            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-header">
                        <h4 class="card-title">
                            Grupo: <?= ($calificacion["id_grupo"]); ?>
                            | Sesión: <?= $exp[2]+1; ?>
                            | Alumno: <?= ($alumnos[$calificacion["id_alumno"]]["nombre"]); ?>
                        </h4>
                    </div>
                    <div class="card-body">

                        <div class="row mb20">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label">Asistencia</label>
                                        <select class="form-control form-group-margin" id="asis" name="<?= $calificacion["id"]; ?>[asis]">
                                            <option value="0" <?php if($calificacion["asis"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["asis"] == 1) echo "selected"; ?>>Si</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Evaluación</label>
                                        <select class="form-control form-group-margin" id="eval" name="<?= $calificacion["id"]; ?>[eval]">
                                            <option value="0" <?php if($calificacion["eval"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["eval"] == 1) echo "selected"; ?>>Si</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Reto 1</label>
                                        <select class="form-control form-group-margin" id="reto1" name="<?= $calificacion["id"]; ?>[reto1]">
                                            <option value="0" <?php if($calificacion["reto1"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["reto1"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($calificacion["reto1"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($calificacion["reto1"] == 3) echo "selected"; ?>>3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label">Reto 2</label>
                                        <select class="form-control form-group-margin" id="reto2" name="<?= $calificacion["id"]; ?>[reto2]">
                                            <option value="0" <?php if($calificacion["reto2"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["reto2"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($calificacion["reto2"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($calificacion["reto2"] == 3) echo "selected"; ?>>3</option>
                                        </select>
                                    </div>                                
                                    <div class="col-md-4">
                                        <label class="control-label">Apli-Herr Envío</label>
                                        <select class="form-control form-group-margin" id="ah_envio" name="<?= $calificacion["id"]; ?>[ah_envio]">
                                            <option value="0" <?php if($calificacion["ah_envio"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["ah_envio"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($calificacion["ah_envio"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($calificacion["ah_envio"] == 3) echo "selected"; ?>>3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Apli-Herr Bonus</label>
                                        <select class="form-control form-group-margin" id="ah_bonus" name="<?= $calificacion["id"]; ?>[ah_bonus]">
                                            <option value="0" <?php if($calificacion["ah_bonus"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["ah_bonus"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($calificacion["ah_bonus"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($calificacion["ah_bonus"] == 3) echo "selected"; ?>>3</option>
                                            <option value="4" <?php if($calificacion["ah_bonus"] == 4) echo "selected"; ?>>4</option>
                                            <option value="5" <?php if($calificacion["ah_bonus"] == 5) echo "selected"; ?>>5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label">Apli-Herr logro</label>
                                        <select class="form-control form-group-margin" id="ah_logro" name="<?= $calificacion["id"]; ?>[ah_logro]">
                                            <option value="0" <?php if($calificacion["ah_logro"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($calificacion["ah_logro"] == 1) echo "selected"; ?>>Si</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <label class="control-label">Insignia</label>
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

        <?php include $roution."views/botones_config.php"; ?>

        <div class="h50"></div>

    </form>

</div>