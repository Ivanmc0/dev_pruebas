
<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th>Aviso</th>
                <th>Evaluador</th>
                <th>Asignaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($evaluadores AS $evaluador){
                    $thisEvaluador = $_TUCOACH->get_data("zoom_users", " AND id = ".$evaluador["id_evaluador"]." AND eliminado = 0 ", 0);
            ?>
                <tr>
                    <td class="vM taC">
                        <div class="btn-group" role="group">
                            <button id="rtn_send_<?= $evaluador["id_evaluador"]; ?>" onclick="Zoom.sendEmailAccess(<?= $evaluador['id_evaluador']; ?>)" class="btn <?php if($thisEvaluador["envioMail"] > 0) echo "btn-outline-warning"; else echo "btn-outline-info"; ?> btn-sm" title="Enviar email con accesos">
                                <?php if($thisEvaluador["envioMail"] > 0){ ?>
                                    <i class="la la-mail-reply-all t16"></i>
                                    <?= $thisEvaluador["envioMail"]; ?>
                                <?php }else{ ?>
                                    <i class="la la-mail-forward t16"></i>
                                <?php } ?>
                            </button>
                        </div>
                    </td>
                    <td class="vM">
                        <?php
                            if($thisEvaluador){
                                echo ($thisEvaluador["nombre"]);
                                echo '<br><small>Documento: '.($thisEvaluador["identificacion"]).'</small>';
                                echo '<br><small>Contraseña: '.($thisEvaluador["pass"]).'</small>';
                            }
                        ?>
                    </td>
                    <td class="vM" style="padding:10px !important;">
                        <?php
                            $complemento = " AND id_evaluador = ".$evaluador["id_evaluador"]." ";
                            $listados = $_TUCOACH->get_data($access_model["tabla"], $complemento." AND id_evaluacion = $id AND eliminado = 0 ORDER BY id DESC ", 1);
                            if($listados) include "evaluaciones_asignaciones_in.php";
                            else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>