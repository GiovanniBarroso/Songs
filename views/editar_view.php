<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modificar Canción</title>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Modificar Canción</h1>

        <!-- Mostrar errores -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <!-- Mostrar mensajes de éxito -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <form class="card shadow-sm p-4" method="POST" action="../public/editar.php">
            <!-- Input oculto para pasar el ID -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($cancion['ID'], ENT_QUOTES, 'UTF-8'); ?>">

            <!-- Campo de Autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" id="autor" name="autor" class="form-control"
                    value="<?php echo htmlspecialchars($cancion['autor'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <!-- Campo de Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" id="titulo" name="titulo" class="form-control"
                    value="<?php echo htmlspecialchars($cancion['titulo'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <!-- Campo de Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha (YYYY-MM-DD)</label>
                <input type="date" id="fecha" name="fecha" class="form-control"
                    value="<?php echo htmlspecialchars($cancion['fecha'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <!-- Botón de enviar -->
            <button type="submit" name="editar" class="btn btn-primary w-100">Modificar</button>
        </form>
    </div>
</body>

</html>