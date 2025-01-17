<?php

require __DIR__ . '/../auth.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Utilidad;
use App\Logger;

$utilidad = new Utilidad();
$logger = Logger::getLogger();

$error = '';
$mensaje = '';
$cancion = null;

$logger->info("Acceso a editar.php", ['usuario' => $_SESSION['usuario'] ?? 'Desconocido']);



// Verificar si el formulario fue enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados
    $id = $_POST['id'] ?? null;
    $autor = trim($_POST['autor'] ?? '');
    $titulo = trim($_POST['titulo'] ?? '');
    $fecha = $_POST['fecha'] ?? '';


    // Validar que los campos no estén vacíos
    if (!$id || empty($autor) || empty($titulo) || empty($fecha)) {
        $error = "Todos los campos son obligatorios.";
        $logger->warning("Campos incompletos en el formulario de edición.", ['id' => $id, 'autor' => $autor, 'titulo' => $titulo, 'fecha' => $fecha]);
    } else {
        // Validar y depurar la fecha
        $fechaPartes = explode('-', $fecha);

        if (count($fechaPartes) === 3) {
            $anio = (int) $fechaPartes[0];
            $mes = (int) $fechaPartes[1];
            $dia = (int) $fechaPartes[2];

            // Truncar el año si está fuera de rango
            if ($anio > 9999) {
                $anio = 3000;
                $logger->warning("El año excede el rango permitido, truncado a 3000.", ['fechaOriginal' => $fecha]);
            } elseif ($anio < 1000) {
                $anio = 1000;
                $logger->warning("El año está por debajo del rango permitido, truncado a 1000.", ['fechaOriginal' => $fecha]);
            }

            // Reconstituir la fecha con el año corregido
            $fecha = sprintf('%04d-%02d-%02d', $anio, $mes, $dia);

            // Validar la fecha completa
            if (!checkdate($mes, $dia, $anio)) {
                $error = "La fecha especificada no es válida.";
                $logger->warning("Fecha inválida proporcionada.", ['fecha' => $fecha]);
            } else {
                // Procesar la edición
                $resultado = $utilidad->editarCancion($id, $autor, $titulo, $fecha);

                if ($resultado) {
                    $logger->info("Canción editada correctamente.", ['id' => $id, 'autor' => $autor, 'titulo' => $titulo, 'fecha' => $fecha]);
                    // Redirigir con un mensaje de éxito
                    header("Location: index.php?mensaje=Canción modificada con éxito.");
                    exit;
                } else {
                    $error = "Error al modificar la canción. Inténtelo nuevamente.";
                    $logger->error("Error al modificar la canción.", ['id' => $id, 'autor' => $autor, 'titulo' => $titulo, 'fecha' => $fecha]);
                }
            }
        } else {
            $error = "La fecha especificada tiene un formato inválido.";
            $logger->warning("Formato de fecha inválido proporcionado.", ['fecha' => $fecha]);
        }
    }
}



// Capturar el ID de la canción desde GET
$id = $_GET['id'] ?? null;

if (!$id) {
    $error = "Error: ID de la canción no proporcionado.";
    $logger->warning("ID no proporcionado para edición.");
} else {
    // Obtener la canción desde la base de datos
    $cancion = $utilidad->obtenerCancionPorId($id);

    if (!$cancion) {
        $error = "Error: Canción no encontrada.";
        $logger->warning("Canción no encontrada para edición.", ['id' => $id]);
    } else {
        $logger->info("Canción encontrada para edición.", [
            'id' => $id,
            'autor' => $cancion['autor'],
            'titulo' => $cancion['titulo'],
            'fecha' => $cancion['fecha']
        ]);
    }
}



// Mostrar la vista
require __DIR__ . '/../views/editar_view.php';