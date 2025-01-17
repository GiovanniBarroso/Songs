<?php

require __DIR__ . '/../auth.php';
require __DIR__ . '/../vendor/autoload.php';

use App\utilidad;
use App\Logger;

// Crear instancia del logger
$logger = Logger::getLogger();
$logger->info("Acceso a index.php", ['usuario' => $_SESSION['usuario'] ?? 'Desconocido']);

$consultasDB = new utilidad();

// Obtener la página actual desde los parámetros GET
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$porPagina = 15; // Número de canciones por página
$offset = ($pagina - 1) * $porPagina;

// Obtener las canciones dependiendo de la fecha seleccionada
$fechaSeleccionada = $_GET['fecha'] ?? null;

try {
    $canciones = $consultasDB->obtenerCanciones($fechaSeleccionada, $porPagina, $offset);
    if ($canciones === false) {
        $logger->error("Error al obtener las canciones");
        die("Error al obtener las canciones.");
    }

    // Obtener el total de canciones para calcular el número de páginas
    $totalCanciones = $consultasDB->contarCanciones($fechaSeleccionada);
    $totalPaginas = ceil($totalCanciones / $porPagina);

    $logger->info("Canciones obtenidas para la página", [
        'pagina' => $pagina,
        'cantidad' => count($canciones)
    ]);

    // Procesar las canciones para determinar si pueden ser borradas o editadas
    $fechaActual = strtotime(date('Y-m-d'));
    foreach ($canciones as &$cancion) {
        $fechaCancion = strtotime($cancion['fecha']);
        $diferenciaDias = ($fechaActual - $fechaCancion) / (60 * 60 * 24);

        $cancion['puedeBorrar'] = $diferenciaDias > 7;
        $cancion['puedeEditar'] = $fechaCancion > $fechaActual;
    }
    unset($cancion);
} catch (Exception $e) {
    $logger->error("Excepción al obtener canciones", ['error' => $e->getMessage()]);
    die("Error al obtener las canciones.");
}

// Obtener todas las fechas disponibles
try {
    $fechasDisponibles = $consultasDB->obtenerFechas();
    if ($fechasDisponibles === false) {
        $logger->error("Error al obtener las fechas disponibles");
        die("Error al obtener las fechas disponibles.");
    }

    $logger->info("Fechas disponibles obtenidas", ['cantidad' => count($fechasDisponibles)]);
} catch (Exception $e) {
    $logger->error("Excepción al obtener fechas", ['error' => $e->getMessage()]);
    die("Error al obtener las fechas disponibles.");
}

// Redirigir a la vista
require __DIR__ . '/../views/index_view.php';
