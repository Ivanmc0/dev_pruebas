<?php include "lateral.php"; ?>

<div class="ionix estr allion bGrowi posR app-<?= $app; ?>">

    <div class="eHeader bfff">
        <?php include "components/header-generic.php"; ?>
    </div>

    <div class="eBody bGray">
        <div class="eContent noMenu">

            <?php if($app != 'platform') include "components/header-apps.php"; ?>

            <div class="ionix <?php if(isset($builder) && $builder) echo ''; else echo 'general1600'; ?>">
                <div class="p50 p30_oS">

