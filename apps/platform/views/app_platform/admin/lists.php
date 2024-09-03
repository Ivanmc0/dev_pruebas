<?php
    if($mud = $_PLATFORM->PermissionValidationModel ($app, $geton[1], true)){
?>

    <div class="row align-items-center bBS1 bCeee pAA20 mb50">

        <div class="col-12 col-lg-7">
            <h2 class="t30 ff4 color000 mb10"><?= $mud['titulo']; ?></h2>
            <h5 class="t18 ff2 color666"><?= $mud['descripcion']; ?></h5>
        </div>
        <div class="col-12 col-lg-5 taR">
            <div id="rtn-botones-<?= $mud['cody']; ?>" class="fR"></div>
        </div>

    </div>

    <div id="front-list"></div>

    <script>
        $(document).ready(function(){
            Crudion.GenerateBottoms(1, '<?= $mud['cody']; ?>', '<?= $app; ?>', 1, <?= $_SESSION['COMPANY']['id']; ?>);
            Crudion.GenerateBottoms(2, '<?= $mud['cody']; ?>', '<?= $app; ?>', 1);
            Crudion.GetList('<?= $mud['cody']; ?>');
            Crudion.Intenso('<?= $mud['cody']; ?>');
        });
    </script>

<?php } else { ?>

    <div class="p50 taC t30 ff0 tU">No posee permisos para cargar esta sección</div>

<?php } ?>