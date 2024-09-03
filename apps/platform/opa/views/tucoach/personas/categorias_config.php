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
                        <div class="col-md-4">
                            <label class="control-label">Nombre</label>
                            <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if($edit) echo ($getThis["nombre"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Perfiles</label>
                            <select class="form-control form-group-margin" id="id_perfil" name="id_perfil" >
                                <option value="0">Ninguno</option>
                                <?php
                                    if($edit)   $estaes = $_TUCOACH->get_data("grw_perfiles", " AND id = ".$getThis["id_perfil"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
                                    else        $estaes = $_TUCOACH->get_data("grw_perfiles", " AND id = $id AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
                                    $getPerfiles = $_TUCOACH->get_data("grw_perfiles", " AND id_test = ".$estaes["id_test"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getPerfiles){
                                        foreach($getPerfiles AS $getPerfil){
                                ?>
                                            <option value="<?= ($getPerfil["id"]); ?>" <?php if(($edit && $getThis["id_perfil"] == $getPerfil["id"]) || ($edit == false && $id == $getPerfil["id"])) echo "selected"; ?>><?= ($getPerfil["nombre"]); ?></option>
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

                </div>
            </div>
        </div>

        <div id="rtn-formion" class="taC mb20"></div>

        <?php include $roution."views/botones_config.php"; ?>

        <div class="h50"></div>

    </form>

</div>

<?php } ?>



