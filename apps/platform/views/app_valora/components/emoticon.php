<?php
    $icono = $_ZOOM->get_data('olc_iconos', ' AND id = '.$emoticon["id_icono"].' AND inactivo = 0 AND eliminado = 0 ', 0);
?>
<div class="jEmoticon p3">

    <div class="bGrowi2 bS1 bCeee rr5">

        <div class="tab bfffT">
            <div class="tabIn t12 ff3" style="padding: 10px 0 10px 8px;">
                <i class="las la-meh-blank"></i> E
                <?= ''//$key+1 ?>
            </div>
            <div class="tabIn taR p3">
                <div class="jEmoticonDiv">
                    <div class="dIB taC">
                        <div onclick="Crudion.Run('event-2fbe4d9b-1df8-11ef-9353-b42e99a5cf9a', 'builder-journey', '2fbe4d9b-1df8-11ef-9353-b42e99a5cf9a', '<?= $emoticon['uuid']; ?>', 0, 1)"
                            class="btn-3 btn-zxxxs">
                            <i class=""><i class="las la-trash"></i></i>
                        </div>
                        <div id="rtn-event-2fbe4d9b-1df8-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p10 taC">
            <div class="t40 mb3"><i class="<?= $icono["icono"]; ?>"></i></div>
            <div class="t10 color666 ff1"><?= $emoticon["nombre"]; ?></div>
        </div>

    </div>

</div>





