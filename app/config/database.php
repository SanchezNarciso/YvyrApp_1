<?php

class Conexion{
    private $SERVIDOR = "localhost";
    private $PORT = 3306;
    private $USUARIO  = "root";
    private $CLAVE = "";
    private $BASEDATOS = "yvyrapp_v1";
    public function conectar(){
        try{ 
            $string_conexion = "mysql:host=".$this->SERVIDOR.
                                    ";port=".$this->PORT.";dbname=".$this->BASEDATOS;
            $conexion = new PDO($string_conexion, $this->USUARIO, $this->CLAVE, 
                                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $conexion;
        } catch (PDOException $e) { // capturar
            error_log($e);
            return null;
        }
    }
    public function cerrar($conexion){
        $conexion = null;
    }
}