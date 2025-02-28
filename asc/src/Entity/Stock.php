<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $libStock = null;

    #[ORM\Column(length: 32)]
    private ?string $abrevStock = null;

    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Parc $parc = null;

    /**
     * @var Collection<int, StockArticle>
     */
    #[ORM\OneToMany(targetEntity: StockArticle::class, mappedBy: 'stock', orphanRemoval: true)]
    private Collection $stockArticles;

    public function __toString() //TODO : voir une autre solution
    {
        return $this->libStock;
    }

    public function __construct()
    {
        $this->stockArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibStock(): ?string
    {
        return $this->libStock;
    }

    public function setLibStock(string $libStock): static
    {
        $this->libStock = $libStock;

        return $this;
    }

    public function getAbrevStock(): ?string
    {
        return $this->abrevStock;
    }

    public function setAbrevStock(string $abrevStock): static
    {
        $this->abrevStock = $abrevStock;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function getParc(): ?Parc
    {
        return $this->parc;
    }

    public function setParc(?Parc $parc): static
    {
        $this->parc = $parc;

        return $this;
    }

    /**
     * @return Collection<int, StockArticle>
     */
    public function getStockArticles(): Collection
    {
        return $this->stockArticles;
    }

    public function addStockArticle(StockArticle $stockArticle): static
    {
        if (!$this->stockArticles->contains($stockArticle)) {
            $this->stockArticles->add($stockArticle);
            $stockArticle->setStock($this);
        }

        return $this;
    }

    public function removeStockArticle(StockArticle $stockArticle): static
    {
        if ($this->stockArticles->removeElement($stockArticle)) {
            // set the owning side to null (unless already changed)
            if ($stockArticle->getStock() === $this) {
                $stockArticle->setStock(null);
            }
        }

        return $this;
    }
}
