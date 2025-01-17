<?php

namespace App;

use PDO;
use PDOException;
use App\Logger;

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
        $logger = Logger::getLogger();

        try {
            $this->conexion = new PDO(
                "mysql:host=$this->host;dbname=$this->baseDatos;charset=utf8mb4",
                $this->usuario,
                $this->password
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $logger->info('Conexión exitosa a la base de datos.');
        } catch (PDOException $e) {
            $logger->error('Error de conexión.', ['error' => $e->getMessage()]);
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
        $logger = Logger::getLogger();

        if ($this->conexion) {
            $logger->info('Conexión obtenida correctamente.');
        } else {
            $logger->warning('Conexión no válida.');
        }
        return $this->conexion;
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }
}
