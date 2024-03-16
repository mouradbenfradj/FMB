<?php

namespace App\Entity\Asc\Stock;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\StockArticle;
use App\Repository\Asc\Stock\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $libStock;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $abrevStock;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity=Parc::class, inversedBy="stocks")
     */
    private $parc;

    /**
     * @ORM\OneToMany(targetEntity=StockArticle::class, mappedBy="stock")
     */
    private $stockArticles;

    public function __construct()
    {
        $this->stockArticles = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->libStock;
    }

    public function initStock(Parc $parc, string $libStock, string $abrevStock, bool $actif)
    {
        $this->parc = $parc;
        $this->libStock = $libStock;
        $this->abrevStock = $abrevStock;
        $this->actif = $actif;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibStock(): ?string
    {
        return $this->libStock;
    }

    public function setLibStock(string $libStock): self
    {
        $this->libStock = $libStock;

        return $this;
    }

    public function getAbrevStock(): ?string
    {
        return $this->abrevStock;
    }

    public function setAbrevStock(string $abrevStock): self
    {
        $this->abrevStock = $abrevStock;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getParc(): ?Parc
    {
        return $this->parc;
    }

    public function setParc(?Parc $parc): self
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

    public function addStockArticle(StockArticle $stockArticle): self
    {
        if (!$this->stockArticles->contains($stockArticle)) {
            $this->stockArticles[] = $stockArticle;
            $stockArticle->setStock($this);
        }

        return $this;
    }

    public function removeStockArticle(StockArticle $stockArticle): self
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
