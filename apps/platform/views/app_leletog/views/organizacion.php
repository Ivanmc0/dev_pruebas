<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $dation = $_LELE->get_red_organization($_SESSION["COMPANY"]["id"], 1);
    // echo '<pre>';
    // print_r($dation);
    // echo '</pre>';
    $dation = serialize($dation);
    // $_SESSION["red"] = $_LELE->load_trabajadores($_SESSION["COMPANY"]["id"]);
?>

<div class="bfff p40 p20_oS bBS1 mb20">
    <div class="dIB fR btnListTrabajadores bVerde colorfff p510 rr5 t12 ff2 cP bHover">
        Ver colaboradores
    </div>
    <div class="ff3 t18 colorVerde mb5">Organigrama de la organización</div>

</div>

<div class="general pAA30">
    <div id="contion"><div class="contenido bS1 bCVerde2"></div></div>
</div>


<script>
    $( document ).ready(function() {
        lele.red("contion", '<?= $dation; ?>');
    });
</script>


<!--

<div class="general">
    <div class="row">
        <div class="col-6">
        <?php


            // $data1 = $_LELE->load_trabajadores(24);

            // echo '<pre>';
            // //print_r($data2);
            // echo '<hr>';
            // print_r($data1);
            // echo '<hr>';
            // print_r($_SESSION);
            // echo '</pre>';

?>
        </div>
        <div class="col-6">
        <?php


// $data1 = $_LELE->get_red_organization(22, 1);

// echo '<pre>';
// //print_r($data2);
// echo '<hr>';
// print_r($data1);
// echo '<hr>';
// print_r($_SESSION);
// echo '</pre>';

?>
        </div>
    </div>
</div>

 -->