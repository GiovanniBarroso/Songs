<?php

namespace App;

use PDO;
use PDOException;
use App\Logger;

class DB
{
    private static $instancia = null;
    private $conexion;
    private $logger;

    private $host;
    private $usuario;
    private $password;
    private $baseDatos;

    private function __construct()
    {
        $this->logger = Logger::getLogger();

        // Cargar configuración
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->usuario = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: '';
        $this->baseDatos = getenv('DB_NAME') ?: 'canciones';

        // Validar configuración
        if (empty($this->host) || empty($this->usuario) || empty($this->baseDatos)) {
            $this->logger->critical('Configuración de base de datos incompleta.');
            die("Error crítico: Configuración de base de datos incompleta.");
        }

        // Intentar conectar
        try {
            $this->conexion = new PDO(
                "mysql:host=$this->host;dbname=$this->baseDatos;charset=utf8mb4",
                $this->usuario,
                $this->password
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->logger->info('Conexión exitosa a la base de datos.', [
                'host' => $this->host,
                'baseDatos' => $this->baseDatos
            ]);
        } catch (PDOException $e) {
            $this->logger->error('Error de conexión.', [
                'error' => $e->getMessage(),
                'host' => $this->host,
                'baseDatos' => $this->baseDatos
            ]);
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
        if ($this->conexion) {
            $this->logger->info('Conexión obtenida correctamente.');
        } else {
            $this->logger->warning('Conexión no válida.');
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
