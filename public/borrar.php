<?php

require __DIR__ . '/../auth.php';
require __DIR__ . '/../vendor/autoload.php';

use App\utilidad;
use App\Logger;

$logger = Logger::getLogger();

$error = '';
$mensaje = '';
$cancion = null;

$utilidad = new utilidad();

// Validar que se recibe un ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $logger->info('Valor de ID antes de intval', ['id' => $id]);
    $cancion = $utilidad->obtenerCancionPorId($id);

    if (!$cancion) {
        $error = 'La canción especificada no existe.';
        $logger->warning('La canción no existe.', ['id' => $id]);
    }
} else {
    $error = 'No se ha proporcionado un ID válido para borrar.';
    $logger->error('ID no válido recibido.');
}



// Si se confirma el borrado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
    $id = intval($_POST['id']);

    if ($id === 0) {
        $error = 'ID inválido. No se puede borrar.';
        $logger->error('ID inválido recibido en POST.', ['id' => $id]);
    } else {
        $resultado = $utilidad->borrarCancion($id);

        if ($resultado) {
            $mensaje = 'La canción se ha borrado correctamente.';
            $logger->info('Borrado exitoso.', ['id' => $id]);
            header('Location: index.php?mensaje=' . urlencode($mensaje));
            exit();
        } else {
            $error = 'Error al intentar borrar la canción.';
            $logger->error('Error en el borrado.', ['id' => $id]);
        }
    }
}


// Cargar la vista
require __DIR__ . '/../views/borrar_view.php';