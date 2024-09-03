<div class="p50 p30_oS">

    <h5 class="ff0 tU t12 mb10">MOMENTO</h5>
    <h1 class="ff3 cPrimary t30 mb20">MOMENTO x: <?= $geton[1]; ?> - y: <?= $geton[2]; ?></h1>

    <?php

        if($momentos = $_VALORA->GetEvents( " eve.id_x = $geton[1] AND eve.id_y = $geton[2] ")){

            foreach ($momentos as $momento) {
                foreach ($momento["eventos"] as $evento) {

                    include 'app_valora/components/evento.php';

                }
            }


        }

    ?>

</div>