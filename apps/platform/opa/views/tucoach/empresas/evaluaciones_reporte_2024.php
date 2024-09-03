<?php if($thisEvaluacion = $_TUCOACH->get_data("grw_tuc_p2b_estudios", " AND id = ".$id." AND eliminado = 0 ORDER BY id DESC ", 0)){ ?>

    <div class="content-body">

        <div class="card" style="overflow:auto;">
            <div class="card-content collapse show">
                <div class="card-header">
                    <div class="btns-ocultar fR taR dN">
                        <small class="pR5">Presione el nivel que desea cerrar o abrir</small>
                        <button class="btn btn-outline-primary btn-glow btn-sm bl-event" id="bl-segmentos" bl="bl-segmentos">Segmentos</button>
                        <button class="btn btn-outline-primary btn-glow btn-sm bl-event" id="bl-comportamientos" bl="bl-comportamientos">Comportamientos</button>
                        <button class="btn btn-outline-primary btn-glow btn-sm bl-event" id="bl-competencias" bl="bl-competencias">Competencias</button>
                    </div>
                    <h4 class="card-title">Reporte Personas a Empresa</h4>
                </div>

                <!-- <button class="btn btn-primary btn-sm" onclick="Zoom.generateReport('personas-empresa', '<?= $id; ?>', '', '', 1)">Ejecutar Reporte en el servidor</button> -->

                <div id="rsp_generateReport" class="p30 p20_oS btn-btns-ocultar">
                    <div class="taC">
                        <button class="btn btn-primary btn-lg btn-btns-ocultar" onclick="Zoom.generateReport('personas-empresa', '<?= $id; ?>', '', '', 0);">Ejecutar Reporte en el servidor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else echo "<div class='card taC pAA50 t30'>"."ERROR: reporte que busca no existe."."</div>"; ?>


<!-- Modal -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="modal fade" id="modalGraph" tabindex="-1" role="dialog" aria-labelledby="modalGraphTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w100" role="document" style="max-width:90%; height:60%; border-radius:0;">
        <div class="modal-content posR" style="border-radius:0; height:100%;">
            <button type="button" class="close posA" data-dismiss="modal" aria-label="Close" style="right:10px; top:5px; z-index:1">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body p30" style="height:100%;">
                <div id="rsp_modalGraph" style="height:100%;"></div>
            </div>
        </div>
    </div>
</div>