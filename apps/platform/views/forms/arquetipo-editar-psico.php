<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "grw_arquetipos", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
 
?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Intereses</div>
            <textarea class="input" type="text" name="descr_psico_intereses"><?php if($edit['descr_psico_intereses'] != '') echo $edit['descr_psico_intereses']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Valores</div>
            <textarea class="input" type="text" name="descr_psico_valores"><?php if($edit['descr_psico_valores'] != '') echo $edit['descr_psico_valores']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Estilos de vida</div>
            <textarea class="input" type="text" name="descr_psico_estilovida"><?php if($edit['descr_psico_estilovida'] != '') echo $edit['descr_psico_estilovida']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Personalidad</div>
            <textarea class="input" type="text" name="descr_psico_personalidad"><?php if($edit['descr_psico_personalidad'] != '') echo $edit['descr_psico_personalidad']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Otros detalles</div>
            <textarea class="input" type="text" name="descr_psico_otro"><?php if($edit['descr_psico_otro'] != '') echo $edit['descr_psico_otro']; ?></textarea>
        </div>
    </div>
</div>

<?php
    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>