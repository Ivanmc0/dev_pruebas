<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">

        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th width="50">Orden</th>
                <th>Modelo</th>
                <th>Tipo</th>
                <th>Introducción</th>
                <th>Características</th>
                <!-- <th>Data</th> -->
                <th width="100">Opciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($listados as $listado) { ?>
                <tr id="tr-<?= $listado["id"]; ?>">
                    <td class="vM taC">
                        <?php
                            if ($listado["inactivo"] == 0) echo '<i class="la la-check success t24"></i>';
                            if ($listado["inactivo"] == 1) echo '<i class="la la-close danger t24"></i>';
                        ?>
                    </td>
                    <td class="vM"><?= ($listado["id"]); ?></td>
                    <td class="vM"><?= ($listado["prioridad"]); ?></td>
                    <td class="vM"><?php if ($listModelos[$listado["id_modelo"]]) echo '<div class="t18 tB">' . ($listModelos[$listado["id_modelo"]]["nombre"]) . '</div>'; ?></td>
                    <td class="vM"><?php if ($listTipos[$listado["id_tipo"]]) echo '<div class="t16">' . ($listTipos[$listado["id_tipo"]]["nombre"]) . '</div>'; ?></td>
                    <td class="vM"><?= ($listado["nombre"]); ?></td>
                    <td class="vM">
                        <?php
                            if($listado["id_modelo"] == 1){                            
                                if ($getPreguntas = $_ZOOM->get_data("grw_lel_preguntas"," AND id_dinamica = " . $listado["id"] . " AND inactivo = 0 AND eliminado = 0 ", 1)) {
                                    echo count($getPreguntas) . ' Preguntas';
                                }else{
                                    echo '0 Preguntas';
                                }
                            }elseif($listado["id_modelo"] == 2){
                                
                                echo '<span class="tB">Max personas:</span> ';                                
                                echo $listado["re_limite_personas"] ? $listado["re_limite_personas"]: "Ilimitado";
                                echo '<hr><span class="tB">Personas habilitadas:</span> ';                                
                                echo $listado["re_personas_habilitadas"] ? $listado["re_personas_habilitadas"]: "Todas";

                                echo '<hr><span class="tB">Max reconocimientos:</span> ';
                                echo $listado["re_limite_reconocimientos"] ? $listado["re_limite_reconocimientos"]: "Ilimitado";
                                echo '<hr><span class="tB">Reconocimientos habilitados:</span> ';
                                echo $listado["re_reconocimientos_habilitados"] ? $listado["re_reconocimientos_habilitados"]: "Todos";

                                echo '<hr><span class="tB">Reconocimientos por persona:</span> ';
                                echo $listado["re_limite_reconocimientos_persona"] ? $listado["re_limite_reconocimientos_persona"]: "Sin límite";

                                echo '<hr><span class="tB">Fecha límite de edición:</span> ';
                                echo $listado["re_fecha_cierre"];

                            }
                        ?>
                    </td>
                    <!-- <td class="vM">
                        <?php
                            echo '<pre>';
                            print_r($listado);
                            echo '<pre>';
                        ?>
                    </td> -->

                    <td class="vM" style="padding:10px !important;"><?php include $roution . "views/botones_listas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>