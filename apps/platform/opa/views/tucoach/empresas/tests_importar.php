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

    <form action="modulos/importar-perfiles" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

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
                            <label class="control-label">Test</label>
                            <select class="form-control form-group-margin" id="id_test" name="id_test">
                                <option value="0">Ninguno</option>
                                <?php
                                    $getGrupos = $_TUCOACH->get_data("grw_tuc_p2p_tests", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getGrupos){
                                        foreach($getGrupos AS $getGrupo){
                                ?>
                                            <option value="<?= ($getGrupo["id"]); ?>" <?php if(($edit && $getThis["id_test"] == $getGrupo["id"]) || ($edit == false && $id == $getGrupo["id"])) echo "selected"; ?>><?= ($getGrupo["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="control-label">
                                Seleccione el excel con formato para importar perfiles
                                <small><a href="<?= $roution?>resources/formatos/formato-perfiles.xlsx" target="_blank" class="">Descargar formato</a></small>
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



