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
                            $grupo = $_TUCOACH->get_data("grw_tuc_p2p_estudios", " AND id = ".$id." AND eliminado = 0 ORDER BY id DESC ", 0);
                            if($grupo) echo ($grupo["nombre"]);
                        ?>
                    </strong>
                </h4>
            </div>
            <?php
                if($id != 0) $complemento = " AND id_evaluacion = $id "; else $complemento = "";
                $evaluadores = $_TUCOACH->get_data($access_model["tabla"], $complemento." AND eliminado = 0 GROUP BY id_evaluador ORDER BY id DESC ", 1);
                if($evaluadores) include "listas/evaluaciones_asignaciones.php";
                else echo '<div class="card-title t30 taC p50">No hay registros</div>';
            ?>
        </div>
    </div>


</div>