<?php
    $color = $_ZOOM->get_data('olc_colores', ' AND id = '.$texto["id_color"].' AND inactivo = 0 AND eliminado = 0 ', 0);
?>
<div class="jNota p3">

    <div class="rr5 bS1 bCeee" style="background:<?= $color["nombre"]; ?>">

        <div class="tab bfffT">
            <div class="tabIn t12 ff3" style="padding: 12px 0 10px 8px;">
                <i class="las la-sticky-note"></i>
                Nota <?= $key_text+1 ?>
            </div>
            <div class="tabIn taR p3">
                <div class="jNotaDiv">
                    <div class="dIB taC">
                        <div onclick="Crudion.Run('event-a737f710-1df7-11ef-9353-b42e99a5cf9a', 'builder-journey', 'a737f710-1df7-11ef-9353-b42e99a5cf9a', '<?= $texto['uuid']; ?>', 0, 1)"
                            class="btn-2 btn-zxxxs">
                            <i class=""><i class="las la-edit"></i></i>
                        </div>
                        <div id="rtn-event-a737f710-1df7-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                    </div>
                    <div class="dIB taC">
                        <div onclick="Crudion.Run('event-a73c4230-1df7-11ef-9353-b42e99a5cf9a', 'builder-journey', 'a73c4230-1df7-11ef-9353-b42e99a5cf9a', '<?= $texto['uuid']; ?>', 0, 1)"
                            class="btn-3 btn-zxxxs">
                            <i class=""><i class="las la-trash"></i></i>
                        </div>
                        <div id="rtn-event-a73c4230-1df7-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="t14 ff1 tInc p15 magion">
            <?= $texto["nombre"]; ?>
        </div>

    </div>

</div>