<?php

namespace App;

use App\DB;
use PDO;

class ConsultasDB
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = DB::obtenerInstancia()->obtenerConexion();
    }

    // Obtener todas las canciones o filtradas por fecha
    public function obtenerCanciones($fecha = null)
    {
        if ($fecha) {
            $stmt = $this->conexion->prepare("SELECT id, autor, titulo, fecha FROM canciones WHERE fecha = :fecha ORDER BY fecha ASC");
            $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        } else {
            $stmt = $this->conexion->prepare("SELECT id, autor, titulo, fecha FROM canciones ORDER BY fecha ASC");
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener canción por ID
    public function obtenerCancionPorId($id)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM canciones WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener fechas únicas
    public function obtenerFechas()
    {
        $stmt = $this->conexion->query("SELECT DISTINCT fecha FROM canciones ORDER BY fecha ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Borrar una canción por ID
    public function borrarCancion($id)
    {
        $stmt = $this->conexion->prepare("DELETE FROM canciones WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0; // Devuelve true si se borró al menos una fila
    }




    // Editar una canción
    public function editarCancion($id, $autor, $titulo, $fecha)
    {
        $stmt = $this->conexion->prepare(
            "UPDATE canciones SET autor = :autor, titulo = :titulo, fecha = :fecha WHERE id = :id"
        );
        $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Obtener usuario por email
    public function obtenerUsuarioPorEmail($email)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM usuario WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un array asociativo si encuentra el usuario
    }
}
