<?php

namespace App\Entity;

use App\Repository\BibliotecaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BibliotecaRepository::class)]
class Biblioteca
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $calle = null;

    #[ORM\Column(length: 255)]
    private ?string $colonia = null;

    #[ORM\Column(length: 10)]
    private ?string $No = null;

    #[ORM\Column(length: 10)]
    private ?string $CP = null;

    #[ORM\Column(length: 10)]
    private ?string $tel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(string $calle): static
    {
        $this->calle = $calle;

        return $this;
    }

    public function getColonia(): ?string
    {
        return $this->colonia;
    }

    public function setColonia(string $colonia): static
    {
        $this->colonia = $colonia;

        return $this;
    }

    public function getNo(): ?string
    {
        return $this->No;
    }

    public function setNo(string $No): static
    {
        $this->No = $No;

        return $this;
    }

    public function getCP(): ?string
    {
        return $this->CP;
    }

    public function setCP(string $CP): static
    {
        $this->CP = $CP;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }
}
