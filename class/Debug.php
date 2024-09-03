<?php

Class Debug
{

	public static function Mostrar( $Debug, $WithDie = 0 )	{
		echo '<pre class="b000 colorVerde taL ff3 p5">';
		echo 'ﾊﾐﾋｰｳｼﾅﾓﾆｻﾜﾂｵﾘｱﾎﾃﾏｹﾒｴｶｷﾑﾕﾗｾﾈｽﾀﾇﾍﾊﾐﾋｰｳｼﾅﾓﾆｻﾜﾂｵﾘｱ'.PHP_EOL.PHP_EOL.PHP_EOL;
		print_r($Debug);
		echo PHP_EOL.PHP_EOL.PHP_EOL.'ﾊﾐﾋｰｳｼﾅﾓﾆｻﾜﾂｵﾘｱﾊﾐﾋｰｳｼﾅﾓﾆｻﾜﾂｵﾘｱﾎﾃﾏｹﾒｴｶｷﾑﾕﾗｾﾈｽﾀﾇﾍ';
		echo '</pre>';
		if ( $WithDie != 0 ) Die();
	}

}