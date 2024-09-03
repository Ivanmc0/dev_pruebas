<div class="dIB">
    <div onclick="Crudion.Run('event-<?= $boton['uuid']; ?>', '<?= $mud['cody']; ?>', '<?= $boton['uuid']; ?>', '<?= $registro['uuid']; ?>', '<?= $fath; ?>', <?php if(isset($pnl)) echo $pnl; else echo 1; ?>)"
        class="btn-<?= $boton["tipo"]; ?> btn-<?= $size; ?>">
        <i class="<?= $boton["icono"]; ?>"></i>
        <span style="<?= $perz; ?>"><?= $boton["modulo"]; ?></span>
    </div>
    <div id="rtn-event-<?= $boton['uuid']; ?>" style="width:0; height:0; overflow:hidden"></div>
</div>