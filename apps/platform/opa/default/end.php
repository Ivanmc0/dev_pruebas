<script src="<?= $dominion; ?>cods/base/js/vendors.min.js"></script>
<script src="<?= $dominion; ?>cods/base/js/app-menu.js"></script>
<script src="<?= $dominion; ?>cods/base/js/app.js"></script>

<!-- PLUGINS-->
<script src="<?= $dominion; ?>resources/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= $dominion; ?>resources/plugins/jFriendly.jquery.js"></script>

<!-- ZOOM-->
<script src="<?= $dominion; ?>cods/js/jquery.form.js"></script>
<script src="<?= $dominion; ?>cods/js/zoom_functions.js"></script>
<script src="<?= $dominion; ?>cods/js/zoom_listener.js"></script>
<script src="https://leletog.com/cods/js/graphion.js"></script>

<?= $lector; ?>

<script>
    $(document).ready(function(){
        $("#nombre").jFriendly("#seo");
        $('#contenido, #texto1, #texto2, #texto3, #texto4').summernote({
            tabDisable: false, disableDragAndDrop: true,
            height: 300, toolbar: [
                ['font', ['bold']],
                ['para', ['ul', 'ol']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });
    });
</script>

</body>

</html>