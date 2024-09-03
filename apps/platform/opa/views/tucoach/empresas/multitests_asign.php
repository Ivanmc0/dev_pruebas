<?php
    $tablus = $access_model["tabla"];
    $edit   = true;
?>

<div class="content-body">

    <form action="configuraciones/accion-all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
                </div>
                <div class="card-body">

                    <div class="row mb20">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <label class="control-label">Tests</label>
                            <input type="hidden" id="id_multitest" name="id_multitest" value="<?= $id; ?>" />
                            <select class="form-control form-group-margin" id="id_test" name="id_test" >
                                <option value="0">Ninguno</option>
                                <?php
                                    $getTests = $_TUCOACH->get_data("grw_tuc_p2b_tests", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getTests){
                                        foreach($getTests AS $getTest){
                                ?>
                                            <option value="<?= ($getTest["id"]); ?>"><?= ($getTest["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="rtn-formion" class="taC mb20"></div>

        <?php include $roution."views/botones_config.php"; ?>

        <div class="h50"></div>

    </form>

</div>