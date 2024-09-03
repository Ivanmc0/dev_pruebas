<?php date_default_timezone_set("America/Bogota");

/*
class ConexionCampai{

    private static $instancia;
    private $dbh;
    private function __construct() {
	    try {
			$this->dbh = new PDO('mysql:host=193.203.166.29;dbname=u851602756_campaiM23', 'u851602756_campaiM23','d>8D>BaSML');
			// $this->dbh = new PDO('mysql:host=database.olcgroup.co;dbname=u851602756_campaiM23', 'u851602756_campaiM23','d>8D>BaSML');
            //$this->dbh = new PDO('mysql:host=localhost;dbname=campaiex_hofu', 'campaiex_hofuUs','OF8K2Gv_Ht4X');

            $this->dbh->exec("utf8");
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
*/



class ConexionCampai{

    private static $instancia;
    private $dbh;

    private function __construct() {

        // $this->dbh = new PDO('mysql:host=193.203.166.29;dbname=u851602756_campaiM23', 'u851602756_campaiM23','d>8D>BaSML');


        try {
            $options   = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_general_ci'");
            $dsn       = "mysql:host=193.203.166.29;dbname=u851602756_campaiM23";
            $this->dbh = new PDO($dsn, 'u851602756_campaiM23', 'd>8D>BaSML', $options);
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