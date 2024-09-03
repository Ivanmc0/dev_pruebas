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

    <form action="modulos/accion-empresas" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php if($edit){ ?>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
        <?php } ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
                    <input type="hidden" id="carpeta" name="carpeta" value="logos/300/" />
                </div>
                <div class="card-body">

                    <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Nombre</label>
                            <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if($edit) echo ($getThis["nombre"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">NIT</label>
                            <input class="form-control form-group-margin" type="text" id="nit" name="nit" value="<?php if($edit) echo ($getThis["nit"]); ?>" />
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
                        <div class="col-md-8">
                            <label class="control-label">Descripción</label>
                            <input class="form-control form-group-margin" type="text" id="descripcion" name="descripcion" value="<?php if($edit) echo ($getThis["descripcion"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Web</label>
                            <input class="form-control form-group-margin" type="text" id="web" name="web" value="<?php if($edit) echo ($getThis["web"]); ?>" />
                        </div>
                    </div>
                    <hr>
                    <div class="row mb20">
                        <div class="col-md-3">
                            <label class="control-label">Contacto</label>
                            <input class="form-control form-group-margin" type="text" id="contacto1" name="contacto1" value="<?php if($edit) echo ($getThis["contacto1"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Cargo</label>
                            <input class="form-control form-group-margin" type="text" id="cargo1" name="cargo1" value="<?php if($edit) echo ($getThis["cargo1"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Teléfono</label>
                            <input class="form-control form-group-margin" type="text" id="telefonos1" name="telefonos1" value="<?php if($edit) echo ($getThis["telefonos1"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Email</label>
                            <input class="form-control form-group-margin" type="text" id="email1" name="email1" value="<?php if($edit) echo ($getThis["email1"]); ?>" />
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-3">
                            <label class="control-label">Contacto 2</label>
                            <input class="form-control form-group-margin" type="text" id="contacto2" name="contacto2" value="<?php if($edit) echo ($getThis["contacto2"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Cargo</label>
                            <input class="form-control form-group-margin" type="text" id="cargo2" name="cargo2" value="<?php if($edit) echo ($getThis["cargo2"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Teléfono</label>
                            <input class="form-control form-group-margin" type="text" id="telefonos2" name="telefonos2" value="<?php if($edit) echo ($getThis["telefonos2"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Email</label>
                            <input class="form-control form-group-margin" type="text" id="email2" name="email2" value="<?php if($edit) echo ($getThis["email2"]); ?>" />
                        </div>
                    </div>

                    <div class="row align-items-center mb20">
                        <div class="col-md-3">
                            <?php
                                if($getThis["logo"] != ""){
                                    echo '<img src="'.$rutaStatic.'logos/300/'.($getThis["logo"]).'" class="" />';
                                } else echo '<img src="'.$sinImagen.'" class="" />';
                            ?>
                        </div>
                        <div class="col-md-9">
                            <label class="control-label">Logo (300 x 220 pixeles)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="logo" name="logo">
                                <label class="custom-file-label" for="logo" aria-describedby="inputGroupFileAddon02">Seleccione una imagen</label>
                            </div>
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