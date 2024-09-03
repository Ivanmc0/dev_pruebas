<?php
    $exp        = explode("-", $id);
    $id_grupo   = $exp[0];
    $num_sesion = $exp[1];

    $sesion       = $_ZOOM->get_data("grw_rkg_sesiones", " AND id_grupo = $id_grupo AND numero = $num_sesion AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
    $grupo        = $_ZOOM->get_data("grw_grupos", " AND id = $id_grupo AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
    $programa     = $_ZOOM->get_data("grw_rkg_programas", " AND id = ".$sesion["id_programa"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
    $modulo       = $_ZOOM->get_data("grw_rkg_modulos", " AND id = ".$sesion["id_modulo"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
    $alumnos      = [];
    $trabajadores = $_ZOOM->order_array_by($_ZOOM->get_data("zoom_users", " AND id_empresa = 100100 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1), "id");

    if($miembros = $_ZOOM->get_data("grw_grupos_miembros", " AND es_lider = 0 AND id_empresa = 100100 AND id_grupo = '".$grupo["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1)){

        foreach ($miembros as $miembro) {

            $alumnos[$miembro["id_trabajador"]] = [
                "id"     => $trabajadores[$miembro["id_trabajador"]]["id"],
                "nombre" => $trabajadores[$miembro["id_trabajador"]]["nombre"],
                "lider"  => $miembro["es_lider"],
            ];

            $alumnos[$miembro["id_trabajador"]]["solucion"] = $_ZOOM->get_data("grw_rkg_soluciones", " AND id_sesion = '".$sesion["id"]."' AND id_trabajador = '".$miembro["id_trabajador"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);

        }

        // Debug::Mostrar($alumnos);

?>

<div class="content-body">

    <div class="">
        <h2 class="mb10"><?= ($grupo["nom_grupo"]); ?>, sesión #<?= ($sesion["numero"]); ?></h2>
        <h4 class="mb40">Programa: <b><?= ($programa["nombre"]); ?></b> | Módulo: <b><?= ($modulo["nombre"]); ?></b></h4>
    </div>

</div>



<div class="content-body">


    <form action="w/accion-soluciones-2024-s2" id="formion" name="formion" method="post" class="form-horizontal zoom_form dB posR">

        <div class="card text-center bfff w250x p1020 bShadow2  bS1 rr3 m0" style="position:fixed; bottom:55px; z-index:1; margin-left:-35px;">
            <button class="btn btn-teal" type="submit"><i class="la la-save t14"></i> &nbsp; Guardar información</button>
        </div>

        <?php
            foreach ($alumnos as $key => $alumno) {
        ?>

            <div class="card bS1">
                <div class="card-content collapse show">
                    <div class="card-header beee bBS1 p10">
                        <h5 class="card-title"><?= ($alumno["nombre"]); ?></h4>
                    </div>
                    <div class="card-body p510">

                        <input type="hidden" name="<?= $alumno["id"]; ?>[id_sesion]" value="<?= $sesion["id"]; ?>">
                        <?php if($alumno["solucion"]){ ?><input type="hidden" name="<?= $alumno["id"]; ?>[id_solucion]" value="<?= $alumno["solucion"]["id"]; ?>"><?php } ?>

                        <div class="row mb10">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <label class="control-label">Participación</label>
                                        <select class="form-control form-group-margin" id="asistencia" name="<?= $alumno["id"]; ?>[asistencia]">
                                            <option value="0" <?php if($alumno["solucion"] && $alumno["solucion"]["asistencia"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($alumno["solucion"] && $alumno["solucion"]["asistencia"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($alumno["solucion"] && $alumno["solucion"]["asistencia"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($alumno["solucion"] && $alumno["solucion"]["asistencia"] == 3) echo "selected"; ?>>3</option>
                                            <option value="4" <?php if($alumno["solucion"] && $alumno["solucion"]["asistencia"] == 4) echo "selected"; ?>>4</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">Evaluación</label>
                                        <select class="form-control form-group-margin" id="evaluacion" name="<?= $alumno["id"]; ?>[evaluacion]">
                                            <option value="0" <?php if($alumno["solucion"] && $alumno["solucion"]["evaluacion"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($alumno["solucion"] && $alumno["solucion"]["evaluacion"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($alumno["solucion"] && $alumno["solucion"]["evaluacion"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($alumno["solucion"] && $alumno["solucion"]["evaluacion"] == 3) echo "selected"; ?>>3</option>
                                            <option value="4" <?php if($alumno["solucion"] && $alumno["solucion"]["evaluacion"] == 4) echo "selected"; ?>>4</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">Reto</label>
                                        <select class="form-control form-group-margin" id="reto" name="<?= $alumno["id"]; ?>[reto]">
                                            <option value="0" <?php if($alumno["solucion"] && $alumno["solucion"]["reto"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($alumno["solucion"] && $alumno["solucion"]["reto"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($alumno["solucion"] && $alumno["solucion"]["reto"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($alumno["solucion"] && $alumno["solucion"]["reto"] == 3) echo "selected"; ?>>3</option>
                                            <option value="4" <?php if($alumno["solucion"] && $alumno["solucion"]["reto"] == 4) echo "selected"; ?>>4</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">Herramienta</label>
                                        <select class="form-control form-group-margin" name="<?= $alumno["id"]; ?>[herramienta]">
                                            <option value="0" <?php if($alumno["solucion"] && $alumno["solucion"]["herramienta"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($alumno["solucion"] && $alumno["solucion"]["herramienta"] == 1) echo "selected"; ?>>1</option>
                                            <option value="2" <?php if($alumno["solucion"] && $alumno["solucion"]["herramienta"] == 2) echo "selected"; ?>>2</option>
                                            <option value="3" <?php if($alumno["solucion"] && $alumno["solucion"]["herramienta"] == 3) echo "selected"; ?>>3</option>
                                            <option value="4" <?php if($alumno["solucion"] && $alumno["solucion"]["herramienta"] == 4) echo "selected"; ?>>4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <?php if($programa["id"] == 2) { ?>
                                            <label class="control-label">Desafío</label>
                                            <select class="form-control form-group-margin" name="<?= $alumno["id"]; ?>[desafio]">
                                                <option value="0" <?php if($alumno["solucion"] && $alumno["solucion"]["desafio"] == 0) echo "selected"; ?>>No</option>
                                                <option value="1" <?php if($alumno["solucion"] && $alumno["solucion"]["desafio"] == 1) echo "selected"; ?>>1</option>
                                                <option value="2" <?php if($alumno["solucion"] && $alumno["solucion"]["desafio"] == 2) echo "selected"; ?>>2</option>
                                                <option value="3" <?php if($alumno["solucion"] && $alumno["solucion"]["desafio"] == 3) echo "selected"; ?>>3</option>
                                                <option value="4" <?php if($alumno["solucion"] && $alumno["solucion"]["desafio"] == 4) echo "selected"; ?>>4</option>
                                                <option value="5" <?php if($alumno["solucion"] && $alumno["solucion"]["desafio"] == 5) echo "selected"; ?>>5</option>
                                            </select>
                                        <?php }else{ ?>
                                            <input type="hidden" name="<?= $alumno["id"]; ?>[desafio]" value="0">
                                        <?php } ?>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label">Medalla</label>
                                        <select class="form-control form-group-margin" name="<?= $alumno["id"]; ?>[medalla]">
                                            <option value="0" <?php if($alumno["solucion"] && $alumno["solucion"]["medalla"] == 0) echo "selected"; ?>>No</option>
                                            <option value="1" <?php if($alumno["solucion"] && $alumno["solucion"]["medalla"] == 1) echo "selected"; ?>>Oro</option>
                                            <option value="2" <?php if($alumno["solucion"] && $alumno["solucion"]["medalla"] == 2) echo "selected"; ?>>Plata</option>
                                        </select>
                                    </div>

                                    <div class="col-2"></div>

                                    <div class="col-4">
                                        <label class="control-label">Bonus</label>
                                        <select class="form-control form-group-margin" name="<?= $alumno["id"]; ?>[bonus]">
                                            <?php
                                                if( $alumno["solucion"] &&
                                                    (
                                                        ($programa["id"] == 2 && $alumno["solucion"]["asistencia"] > 0 && $alumno["solucion"]["evaluacion"] > 0 && $alumno["solucion"]["reto"] > 0 && $alumno["solucion"]["herramienta"] > 0)
                                                        ||
                                                        ($programa["id"] == 1 && $alumno["solucion"]["asistencia"] > 0 && $alumno["solucion"]["evaluacion"] > 0 && $alumno["solucion"]["reto"] > 0)
                                                    )
                                                ){
                                            ?>
                                                <option value="0" <?php if($alumno["solucion"] && $alumno["solucion"]["bonus"] == 0) echo "selected"; ?>>Apto</option>
                                                <option value="4" <?php if($alumno["solucion"] && $alumno["solucion"]["bonus"] == 4) echo "selected"; ?>>+4</option>
                                            <?php }else { ?>
                                                <option value="0" <?php if($alumno["solucion"] && $alumno["solucion"]["bonus"] == 0) echo "selected"; ?>>No cumple</option>
                                            <?php } ?>
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
        ?>

        <div id="rtn-formion" class="taC mb20"></div>

        <?php //include $roution."views/botones_config.php"; ?>

        <div class="h80"></div>

    </form>

</div>

<?php
    } else {
        echo '<div class="card-title t30 taC p50">No hay registros</div>';
    }
?>