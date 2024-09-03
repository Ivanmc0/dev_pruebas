<?php date_default_timezone_set("America/Bogota");


class Conexion{

    private static $instancia;
    private $dbh;

    private function __construct() {

        try {
            $options   = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_general_ci'");
            $dsn       = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}";
            $this->dbh = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $options);
        } catch (PDOException $e) {
            print "¡Error TryCatch!: " . $e->getMessage();
            die();
        }
    }

    public function prepare($sql) {
        return $this->dbh->prepare($sql);
    }

	public function UltimoIDInsertado() {
        return $this->dbh->lastInsertId();
    }

    public static function singleton_conexion(){
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function __clone() {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }

}

date_default_timezone_set('America/Bogota');