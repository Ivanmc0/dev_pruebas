<?php
    $tablus = $access_model["tabla"];
    $edit = false;
    if($id != 0) $edit = true;
    if($edit){
        $getThis = $_TUCOACH->get_data($tablus, " AND id = ".$id." ORDER BY id DESC ", 0);
        if($getThis) $edit = true; else $edit = 2;
    }
    if($edit === 2){
        echo '<div class="taC p40 t24">¡No se encontró la configuración buscaba!</div>';
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
                        <div class="col-md-5">
                            <label class="control-label">Nombre</label>
                            <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if($edit) echo ($getThis["nombre"]); ?>" />
                        </div>
                        <div class="col-md-5">
                            <label class="control-label">Identificación</label>
                            <input class="form-control form-group-margin" type="text" id="identificacion" name="identificacion" value="<?php if($edit) echo ($getThis["identificacion"]); ?>" />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Estado</label>
                            <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                <option value="0" <?php if($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                <option value="1" <?php if($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Teléfono</label>
                            <input class="form-control form-group-margin" type="text" id="telefono" name="telefono" value="<?php if($edit) echo ($getThis["telefono"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">E-mail</label>
                            <input class="form-control form-group-margin" type="text" id="email" name="email" value="<?php if($edit) echo ($getThis["email"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Rol del usuario</label>
                            <select class="form-control form-group-margin" id="id_rol" name="id_rol">
                                <option value="0" <?php if($edit && $getThis["id_rol"] == 0) echo "selected"; ?>>Ninguno</option>
                                <?php
                                    $getRoles = $_TUCOACH->get_data("zoom_roles", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getRoles){
                                        foreach($getRoles AS $getRol){
                                ?>
                                            <option value="<?= ($getRol["id"]); ?>" <?php if($edit && $getThis["id_rol"] == $getRol["id"]) echo "selected"; ?>><?= ($getRol["rol"]); ?></option>
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

<?php } ?>



