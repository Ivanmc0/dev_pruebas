<?php $titleCliente = "Leletog by OLC"; ?>

<link rel="shortcut icon" type="image/x-icon" href="<?= $dominion; ?>favicon.ico">


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Cache-Control" content="public" />
<meta name="vw96.objectype" content="Document" />
<meta name="distribution" content="all" />
<meta name="robots" content="all" />
<meta name="author" content="OLC Group" />
<meta name="language" CONTENT="Spanish" />
<meta name="revisit" content="2 days">

<meta property="og:site_name" content="<?php echo $titleCliente; ?>" />
<meta property="og:type" content="website" />
<meta name="dominion" content="<?= $dominion; ?>" />
<meta name="dominion0" content="<?= $dominion0; ?>" />


<?php

	$keion 			= "";

	if(isset($hom) && $hom){
		$titlion 		= $titleCliente;
		$description 	= "";
		$keion 	   	    = "".$keion;
		$imagion 		= "";
		$urlion 		= "http://".$_SERVER["HTTP_HOST"];
	}else{
		$titlion 		= $titleCliente." | ".ucfirst($geton[0]);
		$description 	= "";
		$keion 	   	    = "".$keion;
		$imagion 		= "";
		$urlion 		= "http://".$_SERVER["HTTP_HOST"]."/".$geton[0];
	}
?>

<title><?= $titlion; ?></title>

<meta name="title" 				content="<?= $titlion; ?>" />
<meta property="og:title" 		content="<?= $titlion; ?>" />
<meta name="description" 		content="<?= $description; ?>" />
<meta property="og:description" content="<?= $description; ?>" />
<meta property="og:image" 		content="<?= $imagion; ?>" />
<meta name="keywords" 			content="<?= $keion; ?>" />
<meta property="og:url" 		content="<?= $urlion; ?>" />
