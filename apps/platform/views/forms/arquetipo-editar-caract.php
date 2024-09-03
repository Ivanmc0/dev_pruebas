<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "grw_arquetipos", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
 
?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Motivaciones y Necesidades</div>
            <div class="color666 t12 ff0 mb10">Factores que impulsan al arquetipo, sus necesidades y deseos.</div>
            <textarea class="input" type="text" name="motivaciones"><?php if($edit['motivaciones'] != '') echo $edit['motivaciones']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Comportamiento de Compra</div>
            <div class="color666 t12 ff0 mb10">Hábitos de compra, canales preferidos, frecuencia de compra.</div>
            <textarea class="input" type="text" name="comportamiento_compra"><?php if($edit['comportamiento_compra'] != '') echo $edit['comportamiento_compra']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Desafíos y Puntos de Dolor</div>
            <div class="color666 t12 ff0 mb10">Problemas comunes que enfrenta y cómo afectan sus decisiones de compra.</div>
            <textarea class="input" type="text" name="desafios"><?php if($edit['desafios'] != '') echo $edit['desafios']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Objetivos y Aspiraciones</div>
            <div class="color666 t12 ff0 mb10">Metas a corto y largo plazo, aspiraciones personales y profesionales.</div>
            <textarea class="input" type="text" name="objetivos"><?php if($edit['objetivos'] != '') echo $edit['objetivos']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Influencias y Decisores</div>
            <div class="color666 t12 ff0 mb10">Personas o factores que influyen en sus decisiones de compra.</div>
            <textarea class="input" type="text" name="influencias"><?php if($edit['influencias'] != '') echo $edit['influencias']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Ejemplos de Productos o Servicios Usados</div>
            <div class="color666 t12 ff0 mb10">roductos o servicios que típicamente utiliza este arquetipo.</div>
            <textarea class="input" type="text" name="ejemplos"><?php if($edit['ejemplos'] != '') echo $edit['ejemplos']; ?></textarea>
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Canales de Comunicación Preferidos</div>
            <div class="color666 t12 ff0 mb10">Medios a través de los cuales prefiere recibir información (redes sociales, correo electrónico, televisión, etc.).</div>
            <textarea class="input" type="text" name="canales"><?php if($edit['canales'] != '') echo $edit['canales']; ?></textarea>
        </div>
    </div>
</div>

<?php
    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>