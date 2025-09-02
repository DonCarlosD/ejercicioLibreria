<?php

namespace App\Entity;

use App\Repository\BibliotecaLibroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BibliotecaLibroRepository::class)]
class BibliotecaLibro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bibliotecaLibros')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Biblioteca $biblioteca = null;

    #[ORM\ManyToOne(inversedBy: 'bibliotecaLibros')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Libro $libro = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\Column(nullable: true)]
    private ?float $puntuacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBiblioteca(): ?Biblioteca
    {
        return $this->biblioteca;
    }

    public function setBiblioteca(?Biblioteca $biblioteca): static
    {
        $this->biblioteca = $biblioteca;

        return $this;
    }

    public function getLibro(): ?Libro
    {
        return $this->libro;
    }

    public function setLibro(?Libro $libro): static
    {
        $this->libro = $libro;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPuntuacion(): ?float
    {
        return $this->puntuacion;
    }

    public function setPuntuacion(?float $puntuacion): static
    {
        $this->puntuacion = $puntuacion;

        return $this;
    }
}
