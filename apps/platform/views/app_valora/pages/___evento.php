<div class="p50 p30_oS">

    <h5 class="ff0 tU t12 mb10">EVENTO</h5>
    <h1 class="ff3 cPrimary t30 mb20"><?= ($evento["nombre"]); ?></h1>
    <!-- <h3 class="ff1 color666 t16 mb50"><?= ($evento["descripcion"]); ?></h3> -->

    <?php

        if($momentos = $_VALORA->GetEvents( " eve.uuid = '$geton[1]' ")){
            foreach ($momentos as $momento) {
                foreach ($momento["eventos"] as $ev) {
                    $evento = $ev;
                }
            }
            include 'app_valora/components/evento.php';
        }

    ?>

</div>