<?php

require __DIR__ . '/../vendor/autoload.php';

use App\ConsultasDB;



// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Verificar que no estén vacíos
    if (empty($email) || empty($password)) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Formato de email inválido.");
    }

    $consultasDB = new ConsultasDB();
    $usuario = $consultasDB->obtenerUsuarioPorEmail($email);

    if ($usuario) {
        // Verificar la contraseña con password_verify
        if (password_verify($password, $usuario['contrasenia_hash'])) {
            $_SESSION['usuario'] = $email; // Guarda el email en la sesión
            header("Location: index_view.php");
            exit();
        } else {
            die("Error: Contraseña incorrecta.");
        }
    } else {
        die("Error: Usuario no encontrado.");
    }
}

?>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center">
        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Iniciar sesión</title>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Iniciar sesión</h1>
        <form class="card shadow-sm p-4" method="POST" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
        </form>
    </div>
</body>

</html>