<?php $tablus = $access_model["tabla"]; ?>

<div class="content-body">

    <div class="card">
        <div class="card-content collapse show">

            <div class="card-header">
                <h4 class="card-title"><?= ($access_model["modulo"]); ?></h4>
                <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
            </div>
            <div class="card-body bGray" style="padding:20px 20px 15px;">

                <?php

                $thisOrg    = $_ZOOM->get_data("grw_organigramas", " AND id = " . $id . " ORDER BY id DESC ", 0);
                $thisCargos = $_ZOOM->get_data("grw_cargos", " AND id_organigrama = " . $id . " AND id_cargo = -1 ORDER BY nombre ASC ", 1);



                // echo '<pre>';
                // print_r($thisCargos);
                // echo '</pre>';

                if ($thisCargos) {


                    echo '
                        <div id="elid" org="'. $id. '">
                            <div id="cargo_-1"></div>
                        </div>
                    ';
                }

                ?>