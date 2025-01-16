<?php

namespace App;

class Cancion
{
    private $id;
    private $titulo;
    private $artista;
    private $fechaAlta;

    public function __construct($id = null, $titulo = "", $artista = "", $fechaAlta = "")
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->artista = $artista;
        $this->fechaAlta = $fechaAlta;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getArtista()
    {
        return $this->artista;
    }

    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    // Setters
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setArtista($artista)
    {
        $this->artista = $artista;
    }

    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    }
}
