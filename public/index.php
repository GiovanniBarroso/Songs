<?php

require __DIR__ . '/../auth.php';
require __DIR__ . '/../vendor/autoload.php';

use App\ConsultasDB;

$consultasDB = new ConsultasDB();

// Obtener las canciones dependiendo de la fecha seleccionada
$fechaSeleccionada = $_GET['fecha'] ?? null;
$canciones = $consultasDB->obtenerCanciones($fechaSeleccionada);

// Obtener todas las fechas disponibles
$fechasDisponibles = $consultasDB->obtenerFechas();

// Redirigir a la vista
require __DIR__ . '/../views/index_view.php';