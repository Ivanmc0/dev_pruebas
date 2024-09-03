<div class="content-body">

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">
                    Listado de
                    <?= ($access_model["modulo"]); ?>
                    de:
                    <strong>
                        <?php
                            $grupo = $_ZOOM->get_data("grw_organigramas", " AND id = ".$id." AND eliminado = 0 ORDER BY id DESC ", 0);
                            if($grupo) echo ($grupo["nombre"]);
                        ?>
                    </strong>
                </h4>
            </div>
            <?php
                if($id != 0) $complemento = " AND id_organigrama = $id "; else $complemento = "";
                $listados = $_ZOOM->get_data($access_model["tabla"], $complemento." AND eliminado = 0 ORDER BY nombre ASC ", 1);
                if($listados) include "listas/".($access_model["archivo"]).".php";
                else echo '<div class="card-title t30 taC p50">No hay registros</div>';
            ?>
        </div>
    </div>

</div>