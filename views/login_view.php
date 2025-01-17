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

        <!-- Mostrar mensaje de error -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center">
                <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <!-- Formulario -->
        <form class="card shadow-sm p-4" method="POST" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required
                    value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8'); ?>">
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