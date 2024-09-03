<?php require_once ('../../appInit.php');

	Logout();

	echo '
		<span>Cerrando sesión...</span>
		<script>
			setTimeout(function(){ $(".rtn_logout").html("¡Hasta pronto!"); }, 1000);
			setTimeout("self.location=dominion", 2000);
		</script>
	';

?>