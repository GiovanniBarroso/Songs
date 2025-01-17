<?php

use PHPUnit\Framework\TestCase;
use App\ConsultasDB;

class ConsultasDBTest extends TestCase
{
    private $consultasDB;

    protected function setUp(): void
    {
        $this->consultasDB = new ConsultasDB();
    }

    public function testObtenerCanciones()
    {
        $resultado = $this->consultasDB->obtenerCanciones();
        $this->assertIsArray($resultado, 'El resultado debe ser un array.');
    }

    public function testObtenerCancionPorId()
    {
        $cancion = $this->consultasDB->obtenerCancionPorId(1);
        $this->assertNotEmpty($cancion, 'La canción con ID 1 debería existir.');
        $this->assertEquals(1, $cancion['ID'], 'El ID de la canción debería ser 1.');
    }

    public function testBorrarCancion()
    {
        $resultado = $this->consultasDB->borrarCancion(999); // ID que no existe
        $this->assertFalse($resultado, 'Intentar borrar un ID inexistente debería devolver false.');
    }
}
