<?php
    $tablus = $access_model["tabla"];
    $edit = false;
    if($id != 0) $edit = true;
    if($edit){
        $getThis = $_ZOOM->get_data($tablus, " AND id = ".$id." ORDER BY id DESC ", 0);
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

                        <div class="col-md-4">
                            <label class="control-label">¿Jefe principal de la empresa?</label>
                            <select class="form-control form-group-margin" id="boss" name="boss">
                                <option value="0" <?php if($edit && $getThis["boss"] == 0) echo "selected"; ?>>Trabajador</option>
                                <option value="1" <?php if($edit && $getThis["boss"] == 1) echo "selected"; ?>>Jefe Principal</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Nombre</label>
                            <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if($edit) echo ($getThis["nombre"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Empresa</label>
                            <select class="form-control form-group-margin" id="id_empresa" name="id_empresa" <?php if($edit) echo "disabled"; ?>>
                                <option value="0">Ninguno</option>
                                <?php
                                    $getGrupos = $_ZOOM->get_data("olc_empresas", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getGrupos){
                                        foreach($getGrupos AS $getGrupo){
                                ?>
                                            <option value="<?= ($getGrupo["id"]); ?>" <?php if(($edit && $getThis["id_empresa"] == $getGrupo["id"]) || ($edit == false && $id == $getGrupo["id"])) echo "selected"; ?>><?= ($getGrupo["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Estado</label>
                            <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                <option value="0" <?php if($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                <option value="1" <?php if($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Número de Documento</label>
                            <input class="form-control form-group-margin" type="text" id="identificacion" name="identificacion" value="<?php if($edit) echo ($getThis["identificacion"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Cargo</label>
                            <input class="form-control form-group-margin" type="text" id="cargo" name="cargo" value="<?php if($edit) echo ($getThis["cargo"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Email</label>
                            <input class="form-control form-group-margin" type="text" id="email" name="email" value="<?php if($edit) echo ($getThis["email"]); ?>" />
                        </div>
                    </div>
                    <!-- <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Detalle 1</label>
                            <input class="form-control form-group-margin" type="text" id="detalle1" name="detalle1" value="<?php if($edit) echo ($getThis["detalle1"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Detalle 2</label>
                            <input class="form-control form-group-margin" type="text" id="detalle2" name="detalle2" value="<?php if($edit) echo ($getThis["detalle2"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Detalle 3</label>
                            <input class="form-control form-group-margin" type="text" id="detalle3" name="detalle3" value="<?php if($edit) echo ($getThis["detalle3"]); ?>" />
                        </div>
                    </div> -->

                </div>
            </div>
        </div>

        <div id="rtn-formion" class="taC mb20"></div>

        <?php include $roution."views/botones_config.php"; ?>

        <div class="h50"></div>

    </form>

</div>

<?php } ?>



