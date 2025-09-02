<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
class Libro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 13)]
    private ?string $isbn = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $editorial = null;

    #[ORM\Column]
    private ?int $noPaginas = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $sinopsis = null;

    #[ORM\ManyToOne(inversedBy: 'libros')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Autor $autor = null;

    /**
     * @var Collection<int, BibliotecaLibro>
     */
    #[ORM\OneToMany(targetEntity: BibliotecaLibro::class, mappedBy: 'libro', orphanRemoval: true)]
    private Collection $bibliotecaLibros;

    public function __construct()
    {
        $this->bibliotecaLibros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getEditorial(): ?string
    {
        return $this->editorial;
    }

    public function setEditorial(string $editorial): static
    {
        $this->editorial = $editorial;

        return $this;
    }

    public function getNoPaginas(): ?int
    {
        return $this->noPaginas;
    }

    public function setNoPaginas(int $noPaginas): static
    {
        $this->noPaginas = $noPaginas;

        return $this;
    }

    public function getSinopsis(): ?string
    {
        return $this->sinopsis;
    }

    public function setSinopsis(?string $sinopsis): static
    {
        $this->sinopsis = $sinopsis;

        return $this;
    }

    public function getAutor(): ?Autor
    {
        return $this->autor;
    }

    public function setAutor(?Autor $autor): static
    {
        $this->autor = $autor;

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
            $bibliotecaLibro->setLibro($this);
        }

        return $this;
    }

    public function removeBibliotecaLibro(BibliotecaLibro $bibliotecaLibro): static
    {
        if ($this->bibliotecaLibros->removeElement($bibliotecaLibro)) {
            // set the owning side to null (unless already changed)
            if ($bibliotecaLibro->getLibro() === $this) {
                $bibliotecaLibro->setLibro(null);
            }
        }

        return $this;
    }
}
