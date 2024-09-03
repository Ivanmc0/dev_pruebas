<?php

    $roution      = isset($hom) ? '' : '../';
    $rutaStatic   = $dominion."static/";
    $sinImagen    = $roution."resources/img/sin-imagen.jpg";
    $zoom_cliente = array("OPA", "OPA by OLC", "OLC Platform Admin", "Copyright ©", "OLC Group", "https://olcgroup.com");

    $lector = "";

?>

<script>console.log(dominion);</script>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>

    <title><?= $zoom_cliente[1]; ?></title>
    <link rel="apple-touch-icon" href="<?= $dominion; ?>resources/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= $dominion; ?>resources/img/favicon-opa.ico">

    <?php
        include "static/run_head.php";
        include "static/metatags.php";
    ?>

</head>

<?php if($roution == "../"){ ?>
    <body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<?php }else{ ?>
    <body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
<?php } ?>

<input type="hidden" id="roution" name="roution" value="<?= $roution; ?>">
