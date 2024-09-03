<div class="content-body">

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">
                    Listado de
                    <?= ($access_model["modulo"]); ?>:
                    <strong>
                        <?php
                            $empresa = $_TUCOACH->get_data("olc_empresas", " AND id = 21 AND eliminado = 0 ORDER BY id DESC ", 0);
                            if($empresa) echo ($empresa["nombre"]);
                        ?>
                    </strong>
                </h4>
            </div>
            <?php
                $complemento = " AND id_empresa = 21 ";
                $evaluadores = $_TUCOACH->get_data("zoom_users", $complemento." AND eliminado = 0 ORDER BY nombre ASC ", 1);
                if($evaluadores) include "listas/lacali.php";
                else echo '<div class="card-title t30 taC p50">No hay registros</div>';
            ?>
        </div>
    </div>


</div>