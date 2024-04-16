<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?TypeProduit $TypeProduit = null;

    #[ORM\OneToMany(targetEntity: Photo::class, mappedBy: 'produit')]
    private Collection $photos;

    #[ORM\OneToMany(targetEntity: Supporter::class, mappedBy: 'produit')]
    private Collection $supporters;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->supporters = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTypeProduit(): ?TypeProduit
    {
        return $this->TypeProduit;
    }

    public function setTypeProduit(?TypeProduit $TypeProduit): static
    {
        $this->TypeProduit = $TypeProduit;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setProduit($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getProduit() === $this) {
                $photo->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Supporter>
     */
    public function getSupporters(): Collection
    {
        return $this->supporters;
    }

    public function addSupporter(Supporter $supporter): static
    {
        if (!$this->supporters->contains($supporter)) {
            $this->supporters->add($supporter);
            $supporter->setProduits($this);
        }

        return $this;
    }

    public function removeSupporter(Supporter $supporter): static
    {
        if ($this->supporters->removeElement($supporter)) {
            // set the owning side to null (unless already changed)
            if ($supporter->getProduits() === $this) {
                $supporter->setProduits(null);
            }
        }

        return $this;
    }

}
