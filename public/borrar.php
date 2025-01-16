<?php

require __DIR__ . '/../auth.php';
require __DIR__ . '/../vendor/autoload.php';

use App\ConsultasDB;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $consultasDB = new ConsultasDB();
        $resultado = $consultasDB->borrarCancion($id);

        if ($resultado) {
            header("Location: index.php?mensaje=Canción eliminada con éxito.");
            exit();
        } else {
            die("Error al borrar la canción.");
        }
    } else {
        die("ID de la canción no proporcionado.");
    }
}
