<?php

namespace App;

/**
 * Clase para realizar las interacciones entre la aplicación y la base de datos
 *
 * @author smonroy
 */
class InformixClass {

    private $query = "";
    private $params = NULL;
    private $dbh;
    private $sth;
    private static $informix = false;

    /**
     * Constructor de la conexión a la base de datos
     * @param string $host ip o dominio donde se encuentra la base de datos
     * @param string $puerto Servicio o puerto al que se realizará la conexión
     * @param string $base Base de datos a la que se realizará la conexión
     * @param string $usuario Usuario de la base de datos
     * @param string $contra Contraseña
     * @param string $servidor Nombre del servidor en informix
     */
    private function __construct(string $host, string  $puerto, string $base, string $usuario, string $contra, string $servidor) {
        $this->dbh = new \PDO('informix:host=' . $host . ';database=' . $base .";service=".$puerto. ";charset=utf8;protocol=onsoctcp;server=".$servidor, $usuario, $contra);
    }

    static function getInformixConnection() {
        $direccion = "148.218.55.31";
        $puerto = "50242";
        $servidor = "desesc_infx";
        $baseDatos = "sescuaem";
        $usuario = "desarrollo";
        $contra = "-desarrollo01";
        if (false === self::$informix) {
            self::$informix = new InformixClass($direccion, $puerto, $baseDatos, $usuario, $contra, $servidor);
        }
        return self::$informix;
    }

    function getQuery() {
        return $this->query;
    }
    
    function getErrorInfo(){
        return $this->dbh->errorInfo();
    }
    
    function beginTransaction(){
        $this->dbh->beginTransaction();
    }
    
    function getLastInsertId(){
        return $this->dbh->lastInsertId();
    }
    
    function fetchAll($query){
        $stmt = $this->dbh->query($query);
        return $stmt->fetchAll();
    }
    
    function rollBack(){
        $this->dbh->rollBack();
    }
    
    function commit(){
        $this->dbh->commit();
    }
    
    function getParams() {
        return $this->params;
    }

    function setQuery($query) {
        $this->query = $query;
    }

    function setParams($params) {
        $this->params = $params;
    }

    /*
     * Regresa un arreglo de objetos con el resultado de la query
     */

    public function select() {
        if (!$this->dbh) {
            throw new \Exception("Falló la conexión a la base de datos");
        }
        if (is_null($this->params)) {
            $stmt = $this->dbh->query($this->query);
        } else {
            $stmt = $this->dbh->prepare($this->query);
            $stmt->execute($this->params);
        }        
        //$stmt = $this->dbh->query($this->query);
        return $stmt;
    }

    /**
     * Ejecuta una query y regresa el número de líneas afectadas
     *
     */
    private function ejecutar() {
        if (!$this->dbh) {
            throw new \Exception("Falló la conexión a la base de datos");
        }

        $stmt = $this->dbh->prepare($this->query);

        return $stmt->execute($this->params);
    }

    public function insert() {
        return $this->ejecutar();
    }

    public function update() {
        return $this->ejecutar();
    }

    public function delete() {
        return $this->ejecutar();
    }

    public function __destruct() {
        $this->sth = null;
        $this->dbh = null;
    }

}
