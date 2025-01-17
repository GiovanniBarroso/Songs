<?php

require __DIR__ . '/../vendor/autoload.php';

use App\ConsultasDB;

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validar campos vacíos
    if (empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Formato de email inválido.";
    } else {
        $consultasDB = new ConsultasDB();
        $usuario = $consultasDB->obtenerUsuarioPorEmail($email);

        if ($usuario && password_verify($password, $usuario['contrasenia_hash'])) {
            $_SESSION['usuario'] = $email; // Guarda el email en la sesión
            header("Location: index.php");
            exit();
        } else {
            $error = "Email o contraseña incorrectos.";
        }
    }
}

// Mostrar la vista con el mensaje de error si lo hay
require __DIR__ . '/../views/login_view.php';
