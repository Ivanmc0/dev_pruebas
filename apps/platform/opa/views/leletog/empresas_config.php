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

// nombre
// proposito
// subdominio
// nit
// web
// logo

?>

<div class="content-body">

    <form action="modulos/accion-empresas" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php if($edit){ ?>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
        <?php } ?>

        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
                    <input type="hidden" id="carpeta" name="carpeta" value="logos/300/" />
                </div>
                <div class="card-body">

                    <div class="row mb20">
                        <div class="col-md-3">
                            <label class="control-label">Nombre empresa</label>
                            <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if($edit) echo ($getThis["nombre"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Subdominio</label>
                            <input class="form-control form-group-margin" type="text" id="subdominio" name="subdominio" value="<?php if($edit) echo ($getThis["subdominio"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">NIT</label>
                            <input class="form-control form-group-margin" type="text" id="nit" name="nit" value="<?php if($edit) echo ($getThis["nit"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Estado</label>
                            <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                <option value="0" <?php if($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                <option value="1" <?php if($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-9">
                            <label class="control-label">Propósito</label>
                            <input class="form-control form-group-margin" type="text" id="proposito" name="proposito" value="<?php if($edit) echo ($getThis["proposito"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Web</label>
                            <input class="form-control form-group-margin" type="text" id="web" name="web" value="<?php if($edit) echo ($getThis["web"]); ?>" />
                        </div>
                    </div>

                    <div class="row align-items-center mb20">
                        <div class="col-md-3">
                            <?php
                                if(isset($getThis) && $getThis["logo"] != ""){
                                    echo '<img src="../../static/logos/300/'.($getThis["logo"]).'" class="" />';
                                } else echo '<img src="'.$sinImagen.'" class="" />';
                            ?>
                        </div>
                        <div class="col-md-9">
                            <label class="control-label">Logo (*** x 70 pixeles) | JPG con fondo blanco</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="logo" name="logo">
                                <label class="custom-file-label" for="logo" aria-describedby="inputGroupFileAddon02">Seleccione una imagen</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php if(!$edit){ ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Primer colaborador y administrador general</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row mb20">
                            <div class="col-md-3">
                                <label class="control-label">Nombres</label>
                                <input class="form-control form-group-margin" type="text" id="nombres" name="nombres" value="<?php if($edit) echo ($getThis["nombres"]); ?>" />
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Apellidos</label>
                                <input class="form-control form-group-margin" type="text" id="apellidos" name="apellidos" value="<?php if($edit) echo ($getThis["apellidos"]); ?>" />
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Documento de identidad</label>
                                <input class="form-control form-group-margin" type="text" id="identificacion" name="identificacion" value="<?php if($edit) echo ($getThis["identificacion"]); ?>" />
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Email</label>
                                <input class="form-control form-group-margin" type="text" id="email" name="email" value="<?php if($edit) echo ($getThis["email"]); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div id="rtn-formion" class="taC mb20"></div>

        <?php include $roution."views/botones_config.php"; ?>

        <div class="h50"></div>

    </form>

</div>

<?php } ?>