<?php

namespace App\Entity;

use App\Repository\BibliotecaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, BibliotecaLibro>
     */
    #[ORM\OneToMany(targetEntity: BibliotecaLibro::class, mappedBy: 'biblioteca', orphanRemoval: true)]
    private Collection $bibliotecaLibros;

    public function __construct()
    {
        $this->bibliotecaLibros = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, BibliotecaLibro>
     */
    public function getBibliotecaLibros(): Collection
    {
        return $this->bibliotecaLibros;
    }

    public function addBibliotecaLibro(BibliotecaLibro $bibliotecaLibro): static
    {
        if (!$this->bibliotecaLibros->contains($bibliotecaLibro)) {
            $this->bibliotecaLibros->add($bibliotecaLibro);
            $bibliotecaLibro->setBiblioteca($this);
        }

        return $this;
    }

    public function removeBibliotecaLibro(BibliotecaLibro $bibliotecaLibro): static
    {
        if ($this->bibliotecaLibros->removeElement($bibliotecaLibro)) {
            // set the owning side to null (unless already changed)
            if ($bibliotecaLibro->getBiblioteca() === $this) {
                $bibliotecaLibro->setBiblioteca(null);
            }
        }

        return $this;
    }
}
