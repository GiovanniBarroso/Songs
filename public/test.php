<?php

require __DIR__ . '/../vendor/autoload.php';

use App\ConsultasDB;

// Prueba de conexión y funciones
$ConsultasDB = new ConsultasDB();

// Obtener fechas
echo "Fechas disponibles:<br>";
print_r($ConsultasDB->obtenerFechas());

// Obtener canciones
echo "<br><br>Canciones disponibles:<br>";
print_r($ConsultasDB->obtenerCanciones());

// Borrar una canción
// echo $utilidad->borrarCancion(1) ? "Canción borrada" : "Error al borrar";

// Modificar una canción
// echo $utilidad->modificarCancion(1, "Nuevo Título", "Nuevo Artista", "2025-01-15") ? "Canción modificada" : "Error al modificar";
