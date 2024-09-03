<?php
    $tablus = $access_model["tabla"];
    $edit = false;
    if($id != 0) $edit = true;
    if($edit){
        $getThis = $_TUCOACH->get_data($tablus, " AND id = ".$id." ORDER BY id DESC ", 0);
        if($getThis) $edit = true; else $edit = 2;
        if($access_model["tipo"] == 1) $edit = false;
    }
    if($edit === 2){
        echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>';
    } else {
?>

<div class="content-body">

    <form action="configuraciones/accion-all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php if($edit){ ?>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
        <?php } ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
                </div>
                <div class="card-body">

                    <div class="row mb20">
                        <div class="col-md-12">
                            <label class="control-label">Nombre</label>
                            <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if($edit) echo ($getThis["nombre"]); ?>" />
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-6">
                            <label class="control-label">Competencias</label>
                            <select class="form-control form-group-margin" id="id_competencia" name="id_competencia" >
                                <option value="0">Ninguno</option>
                                <?php
                                    if($edit)   $estaes = $_TUCOACH->get_data("grw_tuc_p2p_competencias", " AND id = ".$getThis["id_competencia"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
                                    else        $estaes = $_TUCOACH->get_data("grw_tuc_p2p_competencias", " AND id = $id AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
                                    $getCompetencias = $_TUCOACH->get_data("grw_tuc_p2p_competencias", " AND id_categoria = ".$estaes["id_categoria"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getCompetencias){
                                        foreach($getCompetencias AS $getCompentecia){
                                ?>
                                            <option value="<?= ($getCompentecia["id"]); ?>" <?php if(($edit && $getThis["id_competencia"] == $getCompentecia["id"]) || ($edit == false && $id == $getCompentecia["id"])) echo "selected"; ?>><?= ($getCompentecia["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Estado</label>
                            <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                <option value="0" <?php if($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                <option value="1" <?php if($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
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

<?php } ?>



