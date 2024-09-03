<?php
    $access_models = $_TUCOACH->get_models(" AND archivo IS NOT NULL AND id_rol = $rol ORDER BY orden ASC ", 1);
    if($access_models){
        $migas = array();
        foreach($access_models AS $access_model){
            if($funcion == $access_model["cody"]){
                include $roution."views/migas-de-pan.php";
                echo '<div class="app-content content"><div class="content-wrapper">';
?>
                    <div class="content-header row mb-1">
                        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                            <h3 class="content-header-title mb-0 <?php if(count($migas)>0) echo "d-inline-block"; ?>">
                                <?= ($access_model["modulo"]); ?>
                            </h3>
                            <?php if(count($migas)>0){ ?>
                                <div class="row breadcrumbs-top d-inline-block">
                                    <div class="breadcrumb-wrapper col-12">
                                        <ol class="breadcrumb">
                                            <?php foreach(array_reverse($migas) AS $mig){ ?>
                                            <li class="breadcrumb-item">
                                                <?= $mig; ?>
                                            </li>
                                            <?php } ?>
                                        </ol>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="content-header-right col-md-4 col-12 taR taL_oS">
                            <?php include $roution."views/botones_superior.php"; ?>
                        </div>
                    </div>
<?php
               
                $thisFuncion = $access_model;
                //echo $roution."views/".$directorio."/".$access_model["archivo"].".php";
                include $roution."views/".$directorio."/".$access_model["archivo"].".php";
                echo '</div></div>';
            }
        }
    } else echo "ERROR";
?>

