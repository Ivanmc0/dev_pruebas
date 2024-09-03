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

    <form action="modulos/importar-asignaciones" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php if($edit){ ?>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
        <?php } ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
                    <input type="hidden" id="id_evaluacion" name="id_evaluacion" value="<?= $id; ?>" />
                </div>
                <div class="card-body">

                    <div class="row mb20">

                        <div class="col-md-12">
                            <label class="control-label">
                                Seleccione el excel con formato para importar asignaciones
                                <small><a href="<?= $roution?>resources/formatos/formato-asignaciones.xlsx" target="_blank" class="">Descargar formato</a></small>
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="excelion" name="excelion">
                                <label class="custom-file-label" for="excelion" aria-describedby="inputGroupFileAddon02">Seleccione el documento de excel</label>
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



