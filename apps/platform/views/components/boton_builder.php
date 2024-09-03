<?php
    $rreg     = $registro["uuid"];
?>

<div class="dIB">
    <a href="<?= $_SESSION['_DOMINION'].$boton["url"].$rreg; ?>/"
        class="btn-<?= $boton["tipo"]; ?> btn-<?= $size; ?>">
        <i class="<?= $boton["icono"]; ?>"></i>
        <span style="<?= $perz; ?>"><?= $boton["modulo"]; ?></span>
    </a>
    <div id="rtn-event-<?= $boton['uuid']; ?>" style="width:0; height:0; overflow:hidden"></div>
</div>