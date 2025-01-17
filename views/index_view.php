<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <title>Lista de Canciones</title>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">🎵 Lista de Canciones</h1>
            <form method="POST" action="logout.php" class="d-inline">
                <button type="submit" class="logout-btn">Cerrar sesión</button>
            </form>
        </div>

        <!-- Mensaje de éxito -->
        <?php if (!empty($_GET['mensaje'])): ?>
            <div class="alert alert-success text-center">
                <?php echo htmlspecialchars($_GET['mensaje'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de filtro por fecha -->
        <form class="d-flex justify-content-between mb-4 align-items-end">
            <div>
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
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <!-- Tabla de canciones -->
        <div class="table-container">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Autor</th>
                        <th>Título</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($canciones)): ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay canciones disponibles.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($canciones as $cancion): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($cancion['autor'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($cancion['titulo'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($cancion['fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <?php if ($cancion['puedeBorrar']): ?>
                                            <a href="borrar.php?id=<?php echo htmlspecialchars($cancion['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                                               class="btn btn-danger btn-sm">Borrar</a>
                                        <?php endif; ?>
                                        <?php if ($cancion['puedeEditar']): ?>
                                            <a href="editar.php?id=<?php echo htmlspecialchars($cancion['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                                               class="btn btn-warning btn-sm">Editar</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Paginación">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="page-item <?php echo ($pagina === $i) ? 'active' : ''; ?>">
                            <a class="page-link" href="?pagina=<?php echo $i; ?>&fecha=<?php echo htmlspecialchars($fechaSeleccionada, ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>

        <footer>
            <p>&copy; <?php echo date('Y'); ?> Sistema de Gestión de Canciones</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
