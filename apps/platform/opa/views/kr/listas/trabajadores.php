
<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="120">Aviso</th>
                <th>Evaluador</th>
                <th>Gestor de proyectos KR</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($evaluadores AS $evaluador){
            ?>
                <tr>
                    <td class="vM taC">
                        <div class="btn-group" role="group">
                            <button id="rtn_send_<?= $evaluador["id"]; ?>" onclick="Zoom.sendEmailKR(<?= $evaluador['id']; ?>)" class="btn <?php if($evaluador["envioMail"] > 0) echo "btn-outline-warning"; else echo "btn-outline-info"; ?> btn-sm" title="Enviar email con accesos">
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
                        <div class="btn-group" role="group">
                            <?php if($evaluador["kr"] == 0){ ?>
                                <button id="rtn_adkr_<?= $evaluador["id"]; ?>" onclick="Zoom.change_KR_admin(<?= $evaluador['id']; ?>)" class="t16 btn btn-outline-info btn-sm">
                                    <i class="la la-close t14"></i>
                                    Este usuario no gestiona proyectos
                                </button>
                            <?php }else{ ?>
                                <button id="rtn_adkr_<?= $evaluador["id"]; ?>" onclick="Zoom.change_KR_admin(<?= $evaluador['id']; ?>)" class="t16 btn btn-outline-success btn-sm">
                                    <i class="la la-arrow-right t16"></i>
                                    Gestor de proyectos
                                </button>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>