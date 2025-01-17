<?php

namespace App;

use App\DB;
use PDO;
use PDOException;
use App\Logger;

class Utilidad
{
    private $conexion;
    private $logger;

    public function __construct()
    {
        $this->conexion = DB::obtenerInstancia()->obtenerConexion();
        $this->logger = Logger::getLogger();
    }


    
    // Método auxiliar para ejecutar consultas
    private function ejecutarConsulta($query, $params = [])
    {
        try {
            $stmt = $this->conexion->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            $this->logger->error('Error en la consulta SQL', [
                'query' => $query,
                'params' => $params,
                'error' => $e->getMessage()
            ]);
            throw new \Exception("Error en la consulta SQL: " . $e->getMessage());
        }
    }



    // Obtener todas las canciones o filtradas por fecha
    public function obtenerCanciones($fecha = null)
    {
        $query = $fecha
            ? "SELECT id, autor, titulo, fecha FROM canciones WHERE fecha = :fecha ORDER BY fecha ASC"
            : "SELECT id, autor, titulo, fecha FROM canciones ORDER BY fecha ASC";
        $params = $fecha ? ['fecha' => $fecha] : [];

        $resultado = $this->ejecutarConsulta($query, $params)->fetchAll(PDO::FETCH_ASSOC);

        if (!$resultado) {
            $this->logger->warning('No se encontraron canciones', ['fecha' => $fecha]);
        }

        return $resultado;
    }



    // Obtener canción por ID
    public function obtenerCancionPorId($id)
    {
        $query = "SELECT * FROM canciones WHERE id = :id";
        $resultado = $this->ejecutarConsulta($query, ['id' => $id])->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            $this->logger->warning('Canción no encontrada', ['id' => $id]);
        }

        return $resultado;
    }



    // Obtener fechas únicas
    public function obtenerFechas()
    {
        $query = "SELECT DISTINCT fecha FROM canciones ORDER BY fecha ASC";
        $resultado = $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_COLUMN);

        if (!$resultado) {
            $this->logger->warning('No se encontraron fechas disponibles.');
        }

        return $resultado;
    }



    // Borrar una canción por ID
    public function borrarCancion($id)
    {
        $query = "DELETE FROM canciones WHERE id = :id";
        $stmt = $this->ejecutarConsulta($query, ['id' => $id]);
        $exito = $stmt->rowCount() > 0;

        if ($exito) {
            $this->logger->info('Canción borrada correctamente', ['id' => $id]);
        } else {
            $this->logger->warning('No se encontró ninguna canción para borrar', ['id' => $id]);
        }

        return $exito;
    }



    // Editar una canción
    public function editarCancion($id, $autor, $titulo, $fecha)
    {
        $query = "UPDATE canciones SET autor = :autor, titulo = :titulo, fecha = :fecha WHERE id = :id";
        $exito = $this->ejecutarConsulta($query, [
            'autor' => $autor,
            'titulo' => $titulo,
            'fecha' => $fecha,
            'id' => $id
        ])->rowCount() > 0;

        if ($exito) {
            $this->logger->info('Canción editada correctamente', [
                'id' => $id,
                'autor' => $autor,
                'titulo' => $titulo,
                'fecha' => $fecha
            ]);
        } else {
            $this->logger->warning('No se pudo editar la canción', ['id' => $id]);
        }

        return $exito;
    }



    // Obtener usuario por email
    public function obtenerUsuarioPorEmail($email)
    {
        $query = "SELECT * FROM usuario WHERE email = :email";
        $resultado = $this->ejecutarConsulta($query, ['email' => $email])->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            $this->logger->warning('Usuario no encontrado', ['email' => $email]);
        }

        return $resultado;
    }
}