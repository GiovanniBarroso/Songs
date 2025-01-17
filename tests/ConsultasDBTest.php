<?php

use PHPUnit\Framework\TestCase;
use App\utilidad;

class ConsultasDBTest extends TestCase
{
    private $utilidad;

    protected function setUp(): void
    {
        $this->utilidad = new utilidad();
    }

    public function testObtenerCanciones()
    {
        $resultado = $this->utilidad->obtenerCanciones();
        $this->assertIsArray($resultado, 'El resultado debe ser un array.');
    }

    public function testObtenerCancionPorId()
    {
        $cancion = $this->utilidad->obtenerCancionPorId(1);
        $this->assertNotEmpty($cancion, 'La canción con ID 1 debería existir.');
        $this->assertEquals(1, $cancion['ID'], 'El ID de la canción debería ser 1.');
    }

    public function testBorrarCancion()
    {
        $resultado = $this->utilidad->borrarCancion(999); // ID que no existe
        $this->assertFalse($resultado, 'Intentar borrar un ID inexistente debería devolver false.');
    }

    public function testObtenerCancionesFiltradas()
    {
        $fecha = '2024-06-05'; 
        $resultado = $this->utilidad->obtenerCanciones($fecha);

        $this->assertIsArray($resultado, 'El resultado debe ser un array.');
        foreach ($resultado as $cancion) {
            $this->assertEquals($fecha, $cancion['fecha'], "La fecha de cada canción debe coincidir con '$fecha'.");
        }
    }

    public function testEditarCancion()
    {
        $id = 1; 
        $autor = 'Nuevo Autor';
        $titulo = 'Nuevo Título';
        $fecha = '2025-01-01';

        $resultado = $this->utilidad->editarCancion($id, $autor, $titulo, $fecha);

        $this->assertTrue($resultado, 'Editar una canción existente debería devolver true.');

        $cancion = $this->utilidad->obtenerCancionPorId($id);
        $this->assertEquals($autor, $cancion['autor'], 'El autor debería coincidir con el nuevo valor.');
        $this->assertEquals($titulo, $cancion['titulo'], 'El título debería coincidir con el nuevo valor.');
        $this->assertEquals($fecha, $cancion['fecha'], 'La fecha debería coincidir con el nuevo valor.');
    }

    public function testBorrarCancionExistente()
    {
        $id = 2; 
        $resultado = $this->utilidad->borrarCancion($id);

        $this->assertTrue($resultado, 'Borrar un ID existente debería devolver true.');

        $cancion = $this->utilidad->obtenerCancionPorId($id);
        $this->assertEmpty($cancion, 'La canción debería haber sido eliminada.');
    }

}
