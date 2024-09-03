<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <?php
                $rol = $_SESSION["zoom_rol"];
                $z_cats = $_TUCOACH->get_data("zoom_models_cats", " AND inactivo = 0 AND eliminado = 0 ORDER BY orden ASC ", 1);
                if($z_cats){
                    foreach($z_cats as $z_cat){
                        $models = $_TUCOACH->get_models(" AND model.id_modulo = 0 AND id_rol = $rol AND tipo = 0 AND id_categoria = ".$z_cat["id"]." ORDER BY orden ASC ", 1);
                        if($models){
            ?>
                            <li class="navigation-header">
                                <span data-i18n="nav.category.<?= ("caty-".$z_cat["id"]); ?>"><?= ($z_cat["categoria"]); ?></span>
                                <i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Admin Panels"></i>
                            </li>
                        <?php
                                foreach($models as $model){
                        ?>
                                    <li class=" nav-item <?php if($model["cody"] == $z1) echo "open"; ?>">
                                        <a href="<?php if($model["archivo"] != "") echo $roution.$model["directorio"]."/".$model["cody"].".zoom"; else echo "#"; ?>">
                                            <?php if($model["icono"] != "") echo '<i class="'.$model["icono"].'"></i>'; ?>
                                            <span class="menu-title" data-i18n="nav.dash.<?= ("model-".$model["id"]); ?>">
                                                <?= ($model["modulo"]); ?>
                                            </span>
                                        </a>
                        <?php
                                    $modelsN1 = $_TUCOACH->get_models(" AND model.id_modulo = ".$model["id"]." AND id_rol = $rol  AND tipo = 0 ORDER BY orden ASC ", 1);
                                    if($modelsN1){
                                        echo '<ul class="menu-content">';
                                        foreach($modelsN1 as $modelN1){
                        ?>
                                            <li class="<?php if($modelN1["cody"] == $funcion) echo "active"; ?>">
                                                <a class="menu-item" href="<?php if($modelN1["archivo"] != "") echo $roution.$modelN1["directorio"]."/".$modelN1["cody"].".zoom"; else echo "#"; ?>">
                                                    <?php if($modelN1["icono"] != "") echo '<i class="'.$modelN1["icono"].'"></i>'; ?>
                                                    <span class="menu-title" data-i18n="nav.dash.<?= ("model-".$modelN1["id"]); ?>">
                                                        <?= ($modelN1["modulo"]); ?>
                                                    </span>
                                                </a>
                        <?php
                                            $modelsN2 = $_TUCOACH->get_models(" AND model.id_modulo = ".$modelN1["id"]." AND id_rol = $rol  AND tipo = 0 ORDER BY orden ASC ", 1);
                                            if($modelsN2){
                                                echo '<ul class="menu-content">';
                                                foreach($modelsN2 as $modelN2){
                        ?>
                                                    <li class="<?php if($modelN2["cody"] == $funcion) echo "active"; ?>">
                                                        <a class="menu-item" href="<?php if($modelN2["archivo"] != "") echo $roution.$modelN2["directorio"]."/".$modelN2["cody"].".zoom"; else echo "#"; ?>">
                                                            <?php if($modelN2["icono"] != "") echo '<i class="'.$modelN2["icono"].'"></i>'; ?>
                                                            <span class="menu-title" data-i18n="nav.dash.<?= ("model-".$modelN2["id"]); ?>">
                                                                <?= ($modelN2["modulo"]); ?>
                                                            </span>
                                                        </a>
                        <?php
                                                    $modelsN3 = $_TUCOACH->get_models(" AND model.id_modulo = ".$modelN2["id"]." AND id_rol = $rol  AND tipo = 0 ORDER BY orden ASC ", 1);
                                                    if($modelsN3){
                                                        echo '<ul class="menu-content">';
                                                        foreach($modelsN3 as $modelN3){
                        ?>
                                                            <li class="<?php if($modelN3["cody"] == $funcion) echo "active"; ?>">
                                                                <a class="menu-item" href="<?php if($modelN3["archivo"] != "") echo $roution.$modelN3["directorio"]."/".$modelN3["cody"].".zoom"; else echo "#"; ?>">
                                                                    <?php if($modelN3["icono"] != "") echo '<i class="'.$modelN3["icono"].'"></i>'; ?>
                                                                    <span class="menu-title" data-i18n="nav.dash.<?= ("model-".$modelN3["id"]); ?>">
                                                                        <?= ($modelN3["modulo"]); ?>
                                                                    </span>
                                                                </a>
                        <?php
                                                            $modelsN4 = $_TUCOACH->get_models(" AND model.id_modulo = ".$modelN3["id"]." AND id_rol = $rol  AND tipo = 0 ORDER BY orden ASC ", 1);
                                                            if($modelsN4){
                                                                echo '<ul class="menu-content">';
                                                                foreach($modelsN4 as $modelN4){
                        ?>
                                                                    <li class="<?php if($modelN4["cody"] == $funcion) echo "active"; ?>">
                                                                        <a class="menu-item" href="<?php if($modelN4["archivo"] != "") echo $roution.$modelN4["directorio"]."/".$modelN4["cody"].".zoom"; else echo "#"; ?>">
                                                                            <?php if($modelN4["icono"] != "") echo '<i class="'.$modelN4["icono"].'"></i>'; ?>
                                                                            <span class="menu-title" data-i18n="nav.dash.<?= ("model-".$modelN4["id"]); ?>">
                                                                                <?= ($modelN4["modulo"]); ?>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                        <?php
                                                                }
                                                                echo '</ul>';
                                                            }
                                                            echo '</li>';
                                                        }
                                                        echo '</ul>';
                                                    }
                                                    echo '</li>';
                                                }
                                                echo '</ul>';
                                            }
                                            echo '</li>';
                                        }
                                        echo '</ul>';
                                    }
                        ?>
                            </li>
                        <?php
                                }
                            }
                    }
                }
            ?>
        </ul>
    </div>
</div>
