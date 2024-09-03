<?php
	if(isset($apps) && $apps && isset($thisApp) && $thisApp){
		$pagina_titulo      = ($app == "platform") ? "Growi - OLC Group" : $thisApp["name"]." by Growi";
		$pagina_description = $thisApp["description"];
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Cache-Control" content="public" />
<meta name="vw96.objectype" content="Document" />
<meta name="distribution" content="all" />
<meta name="robots" content="all" />
<meta name="author" content="OLC Group" />
<meta name="language" CONTENT="Spanish" />
<meta name="revisit" content="7 days">
<meta property="og:type" content="website" />


<?php

	$pagina_keys        = "";
	$pagina_favicon     = '<link rel="shortcut icon" type="image/x-icon" href="'.$dominion.'resources/favicon-'.$app.'.ico">';
	$pagina_titulo      = $pagina_titulo;
	$pagina_description = "";
	$pagina_keys        = "".$pagina_keys;
	$pagina_image       = "";
	$pagina_url         = $dominion;

?>

<title><?= $pagina_titulo; ?></title>

<?= $pagina_favicon; ?>

<meta property = "og:site_name" 	content = "<?= $pagina_titulo; ?>" />
<meta name     = "title" 			content = "<?= $pagina_titulo; ?>" />
<meta property = "og:title" 		content = "<?= $pagina_titulo; ?>" />
<meta name     = "description" 		content = "<?= $pagina_description; ?>" />
<meta property = "og:description" 	content = "<?= $pagina_description; ?>" />
<meta property = "og:image" 		content = "<?= $pagina_image; ?>" />
<meta name     = "keywords" 		content = "<?= $pagina_keys; ?>" />
<meta property = "og:url" 			content = "<?= $pagina_url; ?>" />


<?php } ?>