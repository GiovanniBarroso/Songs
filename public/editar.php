<?php

require __DIR__ . '/../auth.php';
require __DIR__ . '/../vendor/autoload.php';

use App\ConsultasDB;

$consultasDB = new ConsultasDB();

$error = '';
$mensaje = '';
$cancion = null;

// Verificar si el formulario fue enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados
    $id = $_POST['id'] ?? null;
    $autor = $_POST['autor'] ?? null;
    $titulo = $_POST['titulo'] ?? null;
    $fecha = $_POST['fecha'] ?? null;

    // Validar que los campos no estén vacíos
    if (!$id || !$autor || !$titulo || !$fecha) {
        $error = 'Todos los campos son obligatorios.';
    } else {
        // Validar fecha
        $fechaPartes = explode('-', $fecha);
        if (count($fechaPartes) !== 3 || !checkdate($fechaPartes[1], $fechaPartes[2], $fechaPartes[0])) {
            $error = 'La fecha especificada no es válida.';
        } else {
            // Procesar la edición
            $resultado = $consultasDB->editarCancion($id, $autor, $titulo, $fecha);

            if ($resultado) {
                // Redirigir con un mensaje de éxito
                header("Location: index.php?mensaje=Canción modificada con éxito.");
                exit;
            } else {
                $error = 'Error al modificar la canción. Inténtelo nuevamente.';
            }
        }
    }
}

// Capturar el ID de la canción desde GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $error = 'Error: ID de la canción no proporcionado.';
} else {
    $id = intval($_GET['id']);
    $cancion = $consultasDB->obtenerCancionPorId($id);

    if (!$cancion) {
        $error = 'Error: Canción no encontrada.';
    }
}

// Mostrar la vista
require __DIR__ . '/../views/editar_view.php';
