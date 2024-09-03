<?php

	include $roution."views/general/header.php";

	if($geton[0] == "user" && !isset($geton[1]))	include $roution."views/user/recuperar.php";
	// else if($geton[0] == "contact")             	include $roution."views/contact.php";

	else echo '<script>location.href=$roution."'.$dominion.'";</script>';

	include $roution."views/general/footer.php";

?>