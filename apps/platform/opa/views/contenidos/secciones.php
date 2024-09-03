<?php
    if($id == 0) include "proyectos.php";
    else {
        $progresa = $_TUCOACH->get_projects(" AND relrol.id_proyecto = ".$id." AND relrol.id_rol = ".$_SESSION["zoom_rol"]." ", 0);
?>

    <div class="content-body">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <div id="rtn_list" class="fR taR"></div>
                    <h4 class="card-title">Listado de <?= ($access_model["modulo"]); ?> de <?= ($progresa["proyecto"]); ?> </h4>
                </div>

                    <ul class="nav nav-tabs nav-underline no-hover-bg mb30">
                        <?php
                            $tabsCats = $_TUCOACH->get_data("contenidos_categorias_secciones", " AND id_proyecto = $id AND inactivo = 0 AND eliminado = 0 ORDER BY prioridad ASC ", 1);
                            if($tabsCats){
                                $cont = 1;
                                foreach($tabsCats AS $tabsCat){
                        ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if($cont < 2) echo "active"; ?>" id="tab-<?= ($tabsCat["id"]); ?>" data-toggle="tab"
                                   aria-controls="tab<?= ($tabsCat["id"]); ?>" href="#tab<?= ($tabsCat["id"]); ?>" aria-expanded="<?php if($cont < 2) echo "true"; else echo "false"; ?>">
                                    <?= ($tabsCat["nombre"]); ?>
                                </a>
                            </li>
                        <?php $cont++; }} ?>
                    </ul>
                    <div class="tab-content p0">
                        <?php
                            if($tabsCats){
                                $cont = 1;
                                foreach($tabsCats AS $tabsCat){
                        ?>
                        <div class="tab-pane <?php if($cont < 2) echo "active"; ?> p0" id="tab<?= ($tabsCat["id"]); ?>" aria-labelledby="base-tab<?= ($tabsCat["id"]); ?>" role="tabpanel" aria-expanded="true">
                            <?php
                                if($progresa) {
                                    $listados = $_TUCOACH->get_data($access_model["tabla"], " AND id_proyecto = ".$id." AND id_categoria = ".$tabsCat["id"]." AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($listados) include "listas/".($access_model["archivo"]).".php";
                                    else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                                } else echo '<div class="card-title t30 taC p50">Ud no pesee permisos para acceder a esta zona</div>';
                            ?>
                        </div>
                        <?php $cont++; }} ?>
                    </div>

            </div>
        </div>
    </div>

<?php } ?>