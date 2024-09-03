
<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th>Aviso</th>
                <th>Evaluador</th>
                <th>Asignado</th>
                <th>Perfil completo</th>
                <th>Realizada</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($evaluadores AS $evaluador){
            ?>
                <tr>
                    <td class="vM taC">
                        <div class="btn-group" role="group">
                            <button id="rtn_send_<?= $evaluador["id"]; ?>" onclick="Zoom.sendEmailAccess(<?= $evaluador['id']; ?>)" class="btn <?php if($evaluador["envioMail"] > 0) echo "btn-outline-warning"; else echo "btn-outline-info"; ?> btn-sm" title="Enviar email con accesos">
                                <?php if($evaluador["envioMail"] > 0){ ?>
                                    <i class="la la-mail-reply-all t16"></i>
                                    <?= $evaluador["envioMail"]; ?>
                                <?php }else{ ?>
                                    <i class="la la-mail-forward t16"></i>
                                <?php } ?>
                            </button>
                        </div>
                    </td>
                    <td class="vM">
                        <?php
                                echo ($evaluador["nombre"]);
                                echo '<br><small>Documento: '.($evaluador["identificacion"]).'</small>';
                                echo '<br><small>Contraseña: '.($evaluador["pass"]).'</small>';
                        ?>
                    </td>
                    <td class="vM taC">
                        <div class="dIB rtn_asgEval_<?= $evaluador["id"]; ?>" onclick="Zoom.asignEvaluador(<?= $evaluador['id']; ?>, <?= $id; ?>)">
                            <?php
                                $eval = $_TUCOACH->get_data("grw_tuc_p2b_asignaciones", " AND id_evaluador = ".$evaluador["id"]." AND id_evaluacion = $id AND eliminado = 0 ", 0);
                                if($eval && $eval["inactivo"] == 0){
                            ?>
                                <button class="btn btn-outline-success btn-sm">Asignado <i class="la la-check t14"></i></button>
                            <?php }else{ ?>
                                <button class="btn btn-outline-info btn-sm">Asignar <i class="la la-la la-angle-double-right t14"></i></button>
                            <?php } ?>
                        </div>
                    </td>
                    <td class="vM taC">
                        <?php
                            if($eval && $eval["perfil_completo"] == 1){
                                echo '<i class="la la-check t16 success"></i>';
                            }else{
                                echo '<i class="la la-close t16 danger"></i>';
                            }
                        ?>
                    </td>
                    <td class="vM taC">
                        <?php
                            if($eval && $eval["realizado"] == 1){
                                echo '<i class="la la-check t16 success"></i>';
                            }else{
                                echo '<i class="la la-close t16 danger"></i>';
                            }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>