<div class="content-body">
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">
                    Listado de <?= ($access_model["modulo"]); ?> en
                    <strong>
                        <?php
                            $grupo = $_TUCOACH->get_data("web_contenidos_testimonios_grupo", " AND id = ".$id." AND eliminado = 0 ORDER BY id DESC ", 0);
                            if($grupo) echo ($grupo["nombre"]);
                        ?>
                    </strong>
                </h4>
            </div>
            <?php
                $listados = $_TUCOACH->get_data($access_model["tabla"], " AND id_grupo = ".$id." AND eliminado = 0 ORDER BY prioridad ASC ", 1);
                if($listados) include "listas/".($access_model["archivo"]).".php";
                else echo '<div class="card-title t30 taC p50">No hay registros</div>';
            ?>
        </div>
    </div>
</div>