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
}
