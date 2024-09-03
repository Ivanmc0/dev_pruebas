<?php require_once ('../../appInit.php');

    $iDinamic  = str_replace('event-', '', $_POST["iDinamic"]);
    $exp       = explode('_', $_POST["gist"]);
    $gist      = (isset($exp[0])) ? $exp[0] : 0;
    $iDinamic .= '_'.uniqid();
    $_MOD      = [
        "iDinamic" => $iDinamic,
        "mud"      => $_POST["mud"],
        "event"    => $_POST["even"],
        "gist"    => $gist,
        "fath"     => $_POST["fath"],
        "panel"    => $_POST["panel"],
        "app"      => 'platform',
    ];

 
    if($module = $_PLATFORM->PermissionValidationModel ($_MOD['app'], $_MOD['event'], $_MOD["panel"])){

?>

<script src="<?= $_SESSION["_DOMINION"]; ?>cods/js/crudion.js?v=<?= $_SESSION["_VERTION"].".29"; ?>"></script>


<div class="modal fade" id="modal-<?= $iDinamic; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?= $iDinamic; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"" role="document">
        <div class="modal-content modalion posR">

            <div class="posA wh30 rr50 bHover cP bS2 t16 color999" style="right:10px; top:10px; z-index:10" data-dismiss="modal" aria-label="Close"><div class="vMM"><i class="las la-times"></i></div></div>

            <div class="modal-header type<?= $module["tipo"]; ?> tab">
                <div class="tabIn w60x">
                    <i class="<?= $module['icono']; ?> t60"></i>
                </div>
                <div class="tabIn pL20">
                    <div class="modal-title"><?= $module['titulo']; ?></div>
                    <div class="modal-description"><?= $module['descripcion']; ?></div>
                </div>

            </div>

            <form action="<?= $module['directorio']; ?>/<?= $module['archivo']; ?>" id="frm-<?= $iDinamic; ?>" name="frm-<?= $iDinamic; ?>" method="post" class="form-horizontal">

                <input type="hidden" name="app" value="<?= $_MOD['app']; ?>" />
                <input type="hidden" name="event" value="<?= $_MOD['event']; ?>" />
                <input type="hidden" name="panel" value="<?= $_MOD['panel']; ?>" />
                <input type="hidden" name="idempresa" value="<?= $_SESSION['COMPANY']['id']; ?>" />

                <div class="modal-body type<?= $module["tipo"]; ?>">

                    <?php
 
                        include '../forms/'.$module['archivo'].'.php';
                    ?>

                    <div id="rtn-frm-<?= $iDinamic; ?>" class="taC mt20"></div>

                </div>

                <div class="modal-footer type<?= $module["tipo"]; ?>">

                    <div id="btn-<?= $iDinamic; ?>" class="btn-frm-modal text-center">
                        <div class="btn-cancelar" data-dismiss="modal" aria-label="Close">Cancelar</div>
                        <button class="btn-accion type<?= $module["tipo"]; ?>" type="submit">Guardar</button>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>


<script>
    Crudion.Form('<?= $iDinamic; ?>');
    Crudion.Launcher('<?= $iDinamic; ?>');
</script>

<?php
    } else {
        echo '<div class="p50 taC t30 ff0 tU">No posee permisos para cargar este servicio</div>';
        echo '<script>console.log('.json_encode($_MOD).');</script>';
    }
?>