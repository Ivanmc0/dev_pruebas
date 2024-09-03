<div class="jEvento bfff mb10">

    <div class="tab bGrowi bBS1 bCeee">
        <div class="tabIn p12 colorfff ff2 t14">Evento</div>
        <div class="tabIn p5 taR">
            <div class="jEventoDiv">
                <div class="dIB taC">
                    <div onclick="Crudion.Run('event-1ca8b143-1dcc-11ef-9353-b42e99a5cf9a', 'builder-journey', '1ca8b143-1dcc-11ef-9353-b42e99a5cf9a', '<?= $evento['uuid']; ?>', 0, 1)"
                        class="btn-2 btn-zxxxs">
                        <i class=""><i class="las la-edit"></i></i>
                    </div>
                    <div id="rtn-event-1ca8b143-1dcc-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                </div>
                <div class="dIB taC">
                    <div onclick="Crudion.Run('event-1cb1fd38-1dcc-11ef-9353-b42e99a5cf9a', 'builder-journey', '1cb1fd38-1dcc-11ef-9353-b42e99a5cf9a', '<?= $evento['uuid']; ?>', 0, 1)"
                        class="btn-3 btn-zxxxs">
                        <i class=""><i class="las la-trash"></i></i>
                    </div>
                    <div id="rtn-event-1cb1fd38-1dcc-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bGray p10 bBS1 bCeee">
        <div class="ff3 colorGrowi t16 mb5"><?= $evento["nombre"]; ?></div>
        <div class="ff1 color999 t12 mb10"><?= $evento["descripcion"]; ?></div>
        <?php
            if(isset($evento["arquetipo"])) {
                echo '<div class="bGray">';
                $arquetipo = $evento["arquetipo"];
                include "app_valora/components/arquetipo.php";
                echo '</div>';
            }
        ?>
    </div>



    <div class="p10">
        <div class="taC" style="min-width: 212px;">

<?php
    echo '
        <div class="dIB">
            <div onclick="Crudion.Run(\'event-a73328f2-1df7-11ef-9353-b42e99a5cf9a\', \'builder-journey\', \'a73328f2-1df7-11ef-9353-b42e99a5cf9a\', \''.$registro['uuid'].'\', \''.$registro["id"].','.$evento["id"].'\', 1)"
                class="btn-1 btn-zxxxs">
                <i class=""><i class="las la-plus-circle"></i></i>
                <span style="">Nota</span>
            </div>
            <div id="rtn-event-a73328f2-1df7-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
        </div><div class="dIB">
            <div onclick="Crudion.Run(\'event-2fb430a3-1df8-11ef-9353-b42e99a5cf9a\', \'builder-journey\', \'2fb430a3-1df8-11ef-9353-b42e99a5cf9a\', \''.$registro['uuid'].'\', \''.$registro["id"].','.$evento["id"].'\', 1)"
                class="btn-1 btn-zxxxs">
                <i class=""><i class="las la-plus-circle"></i></i>
                <span style="">Emoticon</span>
            </div>
            <div id="rtn-event-2fb430a3-1df8-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
        </div><div class="dIB">
            <div class="dB taC">
                <div onclick="Crudion.Run(\'event-54dcd5d4-1ddf-11ef-9353-b42e99a5cf9a\', \'builder-journey\', \'54dcd5d4-1ddf-11ef-9353-b42e99a5cf9a\', \''.$registro['uuid'].'\', \''.$registro["id"].','.$evento["id"].'\', 1)"
                    class="btn-1 btn-zxxxs">
                    <i class=""><i class="las la-plus-circle"></i></i>
                    <span style="">Investivación</span>
                </div>
                <div id="rtn-event-54dcd5d4-1ddf-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
            </div>
        </div>
    ';
?>




    </div>






        <?php

            $textos          = $_ZOOM->get_data('grw_val_eventos_textos', ' AND id_evento = '.$evento["id"].' AND inactivo = 0 AND eliminado = 0 ORDER BY orden ASC, id ASC ', 1);
            $emoticons       = $_ZOOM->get_data('grw_val_eventos_emoticons', ' AND id_evento = '.$evento["id"].' AND inactivo = 0 AND eliminado = 0 ORDER BY orden ASC, id ASC ', 1);
            $investigaciones = isset($evento["investigaciones"]) ? $evento["investigaciones"] : 0;

            if($textos || $emoticons || $investigaciones) echo '<div class="h10"></div>';

            if($textos){
                foreach ($textos as $key_text => $texto) {
                    include "app_valora/components/texto.php";
                }
            }
            if($emoticons){
                echo '<div class="row align-items-center justify-content-center p0 m0">';
                foreach ($emoticons as $emoticon) {
                    echo '<div class="col-6 col-lg-4 p0 m0">';
                    include "app_valora/components/emoticon.php";
                    echo '</div>';
                }
                echo '</div>';
            }
            if($investigaciones) {
                foreach ($evento["investigaciones"] as $investigacion) {
                    include "app_valora/components/investigacion.php";
                }
            }
        ?>



    </div>
</div>