<?php

namespace App;

use PDO;
use PDOException;

class DB
{
    private static $instancia = null;
    private $conexion;

    private $host = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $baseDatos = 'canciones';

    private function __construct()
    {
        try {
            $this->conexion = new PDO(
                "mysql:host=$this->host;dbname=$this->baseDatos;charset=utf8mb4",
                $this->usuario,
                $this->password
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public static function obtenerInstancia()
    {
        if (self::$instancia == null) {
            self::$instancia = new DB();
        }
        return self::$instancia;
    }

    public function obtenerConexion()
    {
        return $this->conexion;
    }

    private function __clone()
    {
    }
    public function __wakeup()
    {
    }
}
