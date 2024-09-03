<?php if($app == "okr"){ ?>
    <div class="bGray bShadow3 p20 bBS1 bCeee">
        <div class="color000 ff1 t10 tU mb10">Proyecto OKR</div>
        <div class="cPrimary ff1 t16 mb5"><?= ($proyecto["nombre"]); ?></div>
        <div class="color666 ff0 t14"><?= ucfirst(strtolower(($proyecto["descripcion"]) ?? '')); ?></div>
    </div>
<?php } ?>

<div class="bBS1 bCeee p1020 bHover2 taR cP dN_oS" onclick="Ion.menuExt()">
    <img src="<?= $dominion; ?>resources/img/menu-lateral.png" alt="">
</div>

<div class="p2010">
    <?php
        $condicion = "";
        $rol       = 0;

        if ( $geton[0]==='panel-control'){
            $rol       = $_SESSION["ADMIN"]['id'];
            $condicion = " AND model.id_categoria IN ( 0, 1012, 1013, 1014, 1015, 1016, 1017 ) AND model.tipo = 0 ";
        } else {
            $rol = $_SESSION["WORKER"]['id_rol'];
            $condicion = " AND model.tipo = 0 ";
        }

        if($menu = $_PLATFORM->getOpcionesUsuario($rol, $app, $condicion)){
            echo '<div class="pLR10 mb10">';

            foreach ($menu AS $opcion) {

                $option = $opcion;
                $nivel  = 1;
                include "components/option-menu-3.php";

                if(isset($opcion["hijos"])){
                    echo '<div class="pLR10 mb10">';
                    foreach ($opcion["hijos"] AS $hijo) {

                        $option = $hijo;
                        $nivel  = 2;
                        include "components/option-menu-3.php";

                        if(isset($hijo["hijos"])){
                            echo '<div class="pLR10 mb10">';
                            foreach ($hijo["hijos"] AS $hijo2) {

                                $option = $hijo2;
                                $nivel  = 3;
                                include "components/option-menu-3.php";

                            }
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                }
            }
            echo '</div>';
        }
    ?>

</div>