<div class="content-body">

    <form action="contenidos/accion-fotosmulti" id="formion" name="formion" method="post" class="form-horizontal zoom_form" enctype="multipart/form-data">

        <input type="hidden" id="id_galeria" name="id_galeria" value="<?= $id; ?>" />

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Seleccione las <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="web_contenidos_galerias_imagenes" />
                    <input type="hidden" id="carpeta" name="carpeta" value="galerias/" />
                </div>
                <div class="card-body">
                    <div class="row align-items-center mb20">
                        <div class="col-md-2"></div>
                        <div class="col-12 col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagenes" name="imagenes[]" multiple>
                                <label class="custom-file-label" for="imagenes" aria-describedby="inputGroupFileAddon02">Seleccione las imágenes que desee subir</label>
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

<div class="content-body">
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">
                    Listado de <?= ($access_model["modulo"]); ?>
                    de <?= ($progresa["proyecto"]); ?>
                    en la Galería de fotos:
                    <strong>
                        <?php
                            $grupo = $_TUCOACH->get_data("web_contenidos_galerias", " AND id = ".$id." AND eliminado = 0 ORDER BY id DESC ", 0);
                            if($grupo) echo ($grupo["nombre"]);
                        ?>
                    </strong>
                </h4>
            </div>
            <?php
                $listados = $_TUCOACH->get_data("web_contenidos_galerias_imagenes", " AND id_galeria = ".$grupo["id"]." AND eliminado = 0 ORDER BY prioridad ASC, id ASC ", 1);
                if($listados) include "listas/fotos.php";
                else echo '<div class="card-title t30 taC p50">No hay registros</div>';
            ?>
        </div>
    </div>
</div>