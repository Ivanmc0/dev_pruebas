<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    // function SetPositionArray($array, $campo){
    //     if (!$array) return 0;
    //     try {

    //         $temp = [];
    //         foreach ($array as $key => $value) $temp[$value[$campo]] = $value;
    //         return $temp;

    //     }catch(PDOException $e){
    //         print "¡Error TryCatch!: " . $e->getMessage();
    //     }
    // }


    require_once('../../../../class/classCampai.php');
    $_CAMPAI = new Campai();

    $listados = $_CAMPAI->get_data("productos_presentaciones", " AND eliminado = 0 ORDER BY producto ASC, id DESC ", 1);
    $prod     = SetPositionArray($_CAMPAI->get_data("productos", " AND estado = 1 AND eliminado = 0 ORDER BY id_producto DESC ", 1), 'id_producto');
    $pres     = SetPositionArray($_CAMPAI->get_data("presentaciones", " AND estado = 1  AND eliminado = 0 ORDER BY id_presentacion DESC ", 1), 'id_presentacion');


    echo '<pre class="taL">';
    // print_r($listados);
    // print_r($pres);
    echo '</pre>';




?>

<div class="content-body">

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">Listado de <?= ($access_model["modulo"]); ?></h4>
            </div>
            <?php
                if($listados){


?>


<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th>Producto</th>
                <th>Presentación</th>
                <th>Precio</th>
                <th width="100">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listados AS $listado){ ?>
                <tr id="tr-<?= $listado["id"]; ?>">
                    <td class="vM t14 taC"><?php  echo '<i class="la la-check success t24"></i>'; ?></td>
                    <td class="vM t14"><?php if(isset($prod[$listado["producto"]])) echo ($prod[$listado["producto"]]["nombre_producto"]); ?></td>
                    <td class="vM t14"><?php if(isset($pres[$listado["presentacion"]])) echo ($pres[$listado["presentacion"]]["nombre_presentacion"]); ?></td>
                    <td class="vM t14"><?php if(isset($pres[$listado["presentacion"]])) echo ($pres[$listado["presentacion"]]["precio"]); ?></td>
                    <td class="vM taC">
                        <a href="../campai/productoscampai-editar_<?php if($pres[$listado["presentacion"]]) echo ($pres[$listado["presentacion"]]["id_presentacion"]); ?>.zoom" class="btn btn-outline-primary btn-sm" title="Editar producto">
                            <i class="la la-edit t16"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php

                }
                else echo '<div class="card-title t30 taC p50">No hay registros</div>';
            ?>
        </div>
    </div>

</div>