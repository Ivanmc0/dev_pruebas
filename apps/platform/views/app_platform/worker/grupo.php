<div id="act_lider"></div>

<script>
    $( document ).ready(function() {
        lele.liderGrupo('<?= $_SESSION["COMPANY"]["id"]; ?>', '<?= $_SESSION["WORKER"]["id"]; ?>', 0, 0, '<?= $geton[1]; ?>');
    });
</script>