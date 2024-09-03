<?php
    $proj = "";
    $edit = false;
    $tablus = $access_model["tabla"];

    if($access_model["tipo"] == 1){
        $proj = $id;
        $edit = false;
    }else if($access_model["tipo"] == 2) {
        $getThis    = $_TUCOACH->get_data($tablus, " AND id = ".$id." ORDER BY id DESC ", 0);
        $proj       = $getThis["id_proyecto"];
        $edit       = true;
    }

    $progresa = $_TUCOACH->get_projects(" AND relrol.id_proyecto = ".$proj." AND relrol.id_rol = ".$_SESSION["zoom_rol"]." ", 0);
    if($progresa) {
        if($edit == false || $getThis){
?>



<div class="content-body">

    <form action="contenidos/accion-articulos" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php if($edit){ ?>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
            <input type="hidden" id="nombre" name="nombre" value="<?= ($getThis["nombre"]); ?>" />
            <input type="hidden" id="id_categoria" name="id_categoria" value="<?= $getThis["id_categoria"]; ?>" />
        <?php } ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
                    <input type="hidden" id="carpeta" name="carpeta" value="articulos/" />
                </div>
                <div class="card-body">
                    <div class="row align-items-center mb20">
                        <div class="col-md-3">
                            <?php
                                if($getThis["imagen"] != "")    $thisImagen = $rutaStatic.'articulos/'.($getThis["imagen"]);
                                else                            $thisImagen = $sinImagen;
                            ?>
                            <img src="<?= $thisImagen; ?>" class="w100" />
                        </div>
                        <div class="col-md-9">
                            <label class="control-label">Imágen del blog |<small>Tamaño recomendado 1920 x 800 pixeles</small></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagen" name="imagen">
                                <label class="custom-file-label" for="imagen" aria-describedby="inputGroupFileAddon02">Seleccione una imagen</label>
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

<?php
        }else echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>';
    } else echo '<div class="card-title t30 taC p50">Ud no pesee permisos para acceder a esta zona</div>';
?>