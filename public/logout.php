<?php

require __DIR__ . '/../auth.php'; // Asegura que el usuario esté autenticado
require __DIR__ . '/../vendor/autoload.php';

use App\Logger;

$logger = Logger::getLogger();

// Registrar el cierre de sesión
$usuario = $_SESSION['usuario'] ?? 'Desconocido';
$logger->info("Cerrando sesión", ['usuario' => $usuario]);

// Limpiar todos los datos de la sesión
$_SESSION = [];
session_destroy();

// Redirigir con un mensaje de éxito
header("Location: login.php?mensaje=" . urlencode("Sesión cerrada correctamente."));
exit();
