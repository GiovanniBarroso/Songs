<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Borrar Canción</title>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Borrar Canción</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center">
                <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php else: ?>
            <p class="text-center">¿Está seguro de que desea borrar la siguiente canción?</p>
            <div class="card shadow-sm p-4">
                <p><strong>Autor:</strong>
                    <?php echo htmlspecialchars($cancion['autor'] ?? 'Desconocido', ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <p><strong>Título:</strong>
                    <?php echo htmlspecialchars($cancion['titulo'] ?? 'Desconocido', ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <p><strong>Fecha:</strong>
                    <?php echo htmlspecialchars($cancion['fecha'] ?? 'Desconocida', ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <form class="d-flex justify-content-between" method="POST" action="borrar.php">
                    <input type="hidden" name="id"
                        value="<?php echo htmlspecialchars($cancion['ID'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="submit" name="confirmar" class="btn btn-danger">Borrar</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
