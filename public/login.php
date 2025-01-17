<?php

require __DIR__ . '/../vendor/autoload.php';

use App\utilidad;

session_start();

$error = ''; // Variable para almacenar errores
$email = ''; // Para mantener el valor del campo email en caso de error


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    // Validar campos vacíos
    if (empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato del email es inválido.";
    } else {
        $consultasDB = new utilidad();
        $usuario = $consultasDB->obtenerUsuarioPorEmail($email);

        if (!$usuario) {
            // Usuario no encontrado
            $error = "El email ingresado no está registrado.";
        } elseif (!password_verify($password, $usuario['contrasenia_hash'])) {
            // Contraseña incorrecta
            $error = "La contraseña es incorrecta.";
        } else {
            // Inicio de sesión exitoso
            $_SESSION['usuario'] = $email; // Guarda el email en la sesión
            header("Location: index.php");
            exit();
        }
    }
}


// Mostrar la vista
require __DIR__ . '/../views/login_view.php';