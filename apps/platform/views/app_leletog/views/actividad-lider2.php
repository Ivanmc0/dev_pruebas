
<div class="bfff p40 p20_oS bBS1 mb20">
    <div class="ff3 t18 colorVerde">Balance de actividad como Líder</div>
</div>

<div class="general pAA30">
    <div id="act_lider"></div>
</div>

<script>
    $( document ).ready(function() {
        lele.lider('<?= $_SESSION["COMPANY"]["id"]; ?>', '<?= $_SESSION["WORKER"]["id"]; ?>', 0, '<?= $geton[1]; ?>');
    });
</script>