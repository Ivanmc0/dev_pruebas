<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "grw_arquetipos", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
 
?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Edad</div>
            <textarea class="input" type="text" name="descr_demo_edad"><?php if($edit['descr_demo_edad'] != '') echo $edit['descr_demo_edad']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Género</div>
            <textarea class="input" type="text" name="descr_demo_genero"><?php if($edit['descr_demo_genero'] != '') echo $edit['descr_demo_genero']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Nivel socioeconómico</div>
            <textarea class="input" type="text" name="descr_demo_socioeconomico"><?php if($edit['descr_demo_socioeconomico'] != '') echo $edit['descr_demo_socioeconomico']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Ubicación geográfica</div>
            <textarea class="input" type="text" name="descr_demo_ubicacion"><?php if($edit['descr_demo_ubicacion'] != '') echo $edit['descr_demo_ubicacion']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Otros detalles</div>
            <textarea class="input" type="text" name="descr_demo_otro"><?php if($edit['descr_demo_otro'] != '') echo $edit['descr_demo_otro']; ?></textarea>
        </div>
    </div>
</div>

<?php
    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>