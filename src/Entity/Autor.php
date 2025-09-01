<?php

namespace App\Entity;

use App\Repository\AutorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AutorRepository::class)]
class Autor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidoPaterno = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidoMaterno = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $fechaNac = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getApellidoPaterno(): ?string
    {
        return $this->apellidoPaterno;
    }

    public function setApellidoPaterno(string $apellidoPaterno): static
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    public function getApellidoMaterno(): ?string
    {
        return $this->apellidoMaterno;
    }

    public function setApellidoMaterno(string $apellidoMaterno): static
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    public function getFechaNac(): ?\DateTime
    {
        return $this->fechaNac;
    }

    public function setFechaNac(\DateTime $fechaNac): static
    {
        $this->fechaNac = $fechaNac;

        return $this;
    }
}
