<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Canciones</title>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Canciones</h1>

        <!-- Mensaje de éxito -->
        <?php if (!empty($_GET['mensaje'])): ?>
            <div class="alert alert-success text-center">
                <?php echo htmlspecialchars($_GET['mensaje'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de filtro por fecha -->
        <form class="row g-3 mb-4" method="GET" action="index.php">
            <div class="col-auto">
                <label for="fecha" class="form-label">Filtrar por fecha:</label>
                <select name="fecha" id="fecha" class="form-select">
                    <option value="">Todas las canciones</option>
                    <?php foreach ($fechasDisponibles as $fecha): ?>
                        <option value="<?php echo htmlspecialchars($fecha, ENT_QUOTES, 'UTF-8'); ?>"
                            <?php echo (isset($fechaSeleccionada) && $fechaSeleccionada === $fecha) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($fecha, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto align-self-end">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <!-- Tabla de canciones -->
        <table class="table table-striped table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Autor</th>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($canciones as $cancion): 
        $fechaActual = strtotime(date('Y-m-d'));
        $fechaCancion = strtotime($cancion['fecha']);
        $diferenciaDias = ($fechaActual - $fechaCancion) / (60 * 60 * 24);
    ?>
        <tr>
            <td><?php echo htmlspecialchars($cancion['autor'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($cancion['titulo'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($cancion['fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <div class="d-flex gap-2">
                    <?php if ($diferenciaDias > 7): ?>
                        <!-- Botón Borrar -->
                        <form method="POST" action="borrar.php">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($cancion['id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                        </form>
                    <?php endif; ?>
                    
                    <?php if ($fechaCancion > $fechaActual): ?>
                        <!-- Botón Editar (usando GET para pasar el ID en la URL) -->
                        <a href="editar.php?id=<?php echo htmlspecialchars($cancion['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                           class="btn btn-warning btn-sm">Editar</a>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>


        </table>

        <div class="text-end">
            <a href="logout.php" class="btn btn-outline-secondary">Cerrar sesión</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
