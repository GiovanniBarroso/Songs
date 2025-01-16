<?php

require __DIR__ . '/../auth.php';
require __DIR__ . '/../vendor/autoload.php';

use App\ConsultasDB;

$consultasDB = new ConsultasDB();

// Verificar si el formulario fue enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados
    $id = $_POST['id'] ?? null;
    $autor = $_POST['autor'] ?? null;
    $titulo = $_POST['titulo'] ?? null;
    $fecha = $_POST['fecha'] ?? null;

    // Validar que los campos no estén vacíos
    if (!$id || !$autor || !$titulo || !$fecha) {
        die("Todos los campos son obligatorios.");
    }

    // Procesar la edición
    $resultado = $consultasDB->editarCancion($id, $autor, $titulo, $fecha);

    if ($resultado) {
        // Redirigir con un mensaje de éxito
        header("Location: index.php?mensaje=Canción modificada con éxito.");
        exit;
    } else {
        die("Error al modificar la canción.");
    }
}

// Capturar el ID de la canción desde GET
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Error: ID de la canción no proporcionado.");
}

// Obtener la canción desde la base de datos
$cancion = $consultasDB->obtenerCancionPorId($id);

if (!$cancion) {
    die("Error: Canción no encontrada.");
}

// Mostrar la vista
require __DIR__ . '/../views/editar_view.php';
