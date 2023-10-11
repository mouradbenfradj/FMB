<?php

namespace App\Entity\Asc;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Parc;
use App\Repository\Asc\StockRepository;
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
     * @ORM\OneToMany(targetEntity=StocksArticles::class, mappedBy="stock", orphanRemoval=true)
     */
    private $stocksArticles;

    public function __construct()
    {
        $this->stocksArticles = new ArrayCollection();
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
     * @return Collection<int, StocksArticles>
     */
    public function getStocksArticles(): Collection
    {
        return $this->stocksArticles;
    }

    public function addStocksArticle(StocksArticles $stocksArticle): self
    {
        if (!$this->stocksArticles->contains($stocksArticle)) {
            $this->stocksArticles[] = $stocksArticle;
            $stocksArticle->setStock($this);
        }

        return $this;
    }

    public function removeStocksArticle(StocksArticles $stocksArticle): self
    {
        if ($this->stocksArticles->removeElement($stocksArticle)) {
            // set the owning side to null (unless already changed)
            if ($stocksArticle->getStock() === $this) {
                $stocksArticle->setStock(null);
            }
        }

        return $this;
    }
}
