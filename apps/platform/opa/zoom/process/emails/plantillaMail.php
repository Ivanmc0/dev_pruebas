<?php

	$correoStart 	=  "
						<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
						<div style='background:#460479; padding:20px; width:560px; margin:10px auto; border:2px solid #460479; border-radius:5px;'>
							<center><img src='https://olcgroup.co/resources/img/logo_tucoach.png' width='250' alt='' /></center>
							<div style='background:#fff; width:80%; padding:20px; margin:30px auto 20px;'>
						";
	$correoEndAdmin	=  "
							</div>
							<p style='font-size:10px; text-align:center;width:80%; margin:0 auto; color:#fff'>Por favor no responda este mensaje, es generado automáticamente por el sistema.</p>
						</div>
						";

	$zoomail_contenido = $correoStart.$zoomail_contenido.$correoEndAdmin;

?>
