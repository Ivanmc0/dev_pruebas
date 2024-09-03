<?php

class Cookies {

	public function Set ( $name, $value, $seconds ) {
		setcookie($name, $value,(time()+$seconds),'/', $_ENV['OLCDOMINIO'], false, true);
	}

	public function Verify ( $name ) {
		return isset($_COOKIE[$name]) ;
	}

	public function Get ( $name ) {
		if(isset($_COOKIE[$name])) return $_COOKIE[$name];
		else return 0;
	}

	public function Destroy ( $name ) {
		if(isset($_COOKIE[$name])){
				setcookie($name, '',(time()-3600),'/', $_ENV['OLCDOMINIO'], false, true);
		}
	}

}