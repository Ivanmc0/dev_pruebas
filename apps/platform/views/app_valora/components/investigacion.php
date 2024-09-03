 

<div class="p3">

    <div class="jInvestigacion jInvestigacion<?= $key; ?> rr5 bS1 bCeee">

        <div class="tab bfffT">
            <div class="tabIn t12 ff3" style="padding: 12px 0 10px 8px;">
                <i class="las la-flask"></i>
                Investigación
            </div>
            <div class="tabIn taR p3">
                <div class="jInvestigacionDiv">
                    <div class="dIB taC">
                        <div onclick="Crudion.Run('event-54e2b695-1ddf-11ef-9353-b42e99a5cf9a', 'builder-journey', '54e2b695-1ddf-11ef-9353-b42e99a5cf9a', '<?= $investigacion['uuid']; ?>', 0, 1)"
                            class="btn-2 btn-zxxxs">
                            <i class=""><i class="las la-edit"></i></i>
                        </div>
                        <div id="rtn-event-54e2b695-1ddf-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                    </div>
                    <div class="dIB taC">
                        <div onclick="Crudion.Run('event-54ea62dc-1ddf-11ef-9353-b42e99a5cf9a', 'builder-journey', '54ea62dc-1ddf-11ef-9353-b42e99a5cf9a', '<?= $investigacion['uuid']; ?>', 0, 1)"
                            class="btn-3 btn-zxxxs">
                            <i class=""><i class="las la-trash"></i></i>
                        </div>
                        <div id="rtn-event-54ea62dc-1ddf-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p15">

            <div class="ff3 colorGrowi t16 mb5"><?= $investigacion["nombre"]; ?></div>
            <div class="ff1 color999 t12 mb10"><?= $investigacion["descripcion"]; ?></div>

            <div class="ff1 color333 cPrimary t12 mt5 mb5">Encuesta: <?= $investigacion["nombre_encuesta"]; ?></div>
            <div class="ff1 color333 cPrimary t12">
                <?php
                    if($investigacion["id_publico"] == 1) echo 'Público: Anónimo';
                    if($investigacion["id_publico"] == 2) echo 'Público: Externo';
                    if($investigacion["id_publico"] == 3) echo 'Público: Interno';
                ?>
            </div>
            <?php if($investigacion["id_publico"] != 1) { ?>
                <div class="ff1 color333 cPrimary t12 mt5">
                    Lista Externa: <?= $investigacion["nombre_publico_listado"]; ?>
                </div>
            <?php } ?>

            <div class="dIB taC mt10">
                <a href="<?= $_SESSION['_DOMINION']; ?>panel-control/valoraciones/valoracion-detalle/reporte-investigacion/<?= $investigacion["uuid"]; ?>/""
                    class="btn-1 btn-zxs">
                    <i class=""><i class="las la-external-link-alt"></i></i>
                    <span>Ver reporte</span>
                </a>
            </div>

        </div>

    </div>
</div>


