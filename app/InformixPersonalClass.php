<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InformixPersonalClass
 *
 * @author smonroy
 */
class InformixPersonalClass {
    
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
    private function __construct(string $host, string $servidor, string $baseDatos, string  $puerto, string $usuario, string $contra) {

        $serverInfo = 'informix:host='. $host .';'
        .'server='  . $servidor .';'
        .'database='. $baseDatos .';'
        .'service=' . $puerto. ';'
        .'protocol=onsoctcp;'
        .'EnableScrollableCursors=1;';

        $this->dbh = new \PDO($serverInfo, $usuario, $contra);
    }

    /**
     * Devuelve una instancia de la conexión
     */
    static function getInformixConnection() {
        $host      = "148.218.55.31";
        $servidor  = "desper_infx";
        $baseDatos = "dbperson";
        $puerto    = "50240";
        $usuario   = "consgoogle";
        $contra    = ".c0n5j3sg0*78";

        if (false === self::$informix) {
            self::$informix = new InformixPersonalClass($host, $servidor, $baseDatos, $puerto, $usuario, $contra);
        }
        return self::$informix;
    }

    function query($sql)
    {
        $prep = $this->dbh->prepare($sql);
        $prep->execute();
        $result = $prep->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
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
            throw new Exception("Falló la conexión a la base de datos");
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
            throw new Exception("Falló la conexión a la base de datos");
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
