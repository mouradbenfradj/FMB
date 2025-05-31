<?php

namespace App\Entity;

use App\Repository\StockArticleSnRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockArticleSnRepository::class)]
class StockArticleSn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $snQte = null;

    #[ORM\Column(length: 32)]
    private ?string $numeroSerie = null;

    #[ORM\ManyToOne(inversedBy: 'stockArticleSns')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StockArticle $stockArticle = null;

    /**
     * @var Collection<int, StockCorde>
     */
    #[ORM\OneToMany(targetEntity: StockCorde::class, mappedBy: 'stockArticleSn')]
    private Collection $stockCordes;

    /**
     * @var Collection<int, StockLanterne>
     */
    #[ORM\OneToMany(targetEntity: StockLanterne::class, mappedBy: 'stockArticleSn')]
    private Collection $stockLanternes;

    public function __toString(): string
    {
        return  $this->stockArticle->getArticles()->getLibArticle() . ' ' . $this->numeroSerie ?? 'StockArticleSn';
    }
    public function __construct()
    {
        $this->stockCordes = new ArrayCollection();
        $this->stockLanternes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSnQte(): ?float
    {
        return $this->snQte;
    }

    public function setSnQte(float $snQte): static
    {
        $this->snQte = $snQte;

        return $this;
    }

    public function getNumeroSerie(): ?string
    {
        return $this->numeroSerie;
    }

    public function setNumeroSerie(string $numeroSerie): static
    {
        $this->numeroSerie = $numeroSerie;

        return $this;
    }

    public function getStockArticle(): ?StockArticle
    {
        return $this->stockArticle;
    }

    public function setStockArticle(?StockArticle $stockArticle): static
    {
        $this->stockArticle = $stockArticle;

        return $this;
    }

    /**
     * @return Collection<int, StockCorde>
     */
    public function getStockCordes(): Collection
    {
        return $this->stockCordes;
    }

    public function addStockCorde(StockCorde $stockCorde): static
    {
        if (!$this->stockCordes->contains($stockCorde)) {
            $this->stockCordes->add($stockCorde);
            $stockCorde->setStockArticleSn($this);
        }

        return $this;
    }

    public function removeStockCorde(StockCorde $stockCorde): static
    {
        if ($this->stockCordes->removeElement($stockCorde)) {
            // set the owning side to null (unless already changed)
            if ($stockCorde->getStockArticleSn() === $this) {
                $stockCorde->setStockArticleSn(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StockLanterne>
     */
    public function getStockLanternes(): Collection
    {
        return $this->stockLanternes;
    }

    public function addStockLanterne(StockLanterne $stockLanterne): static
    {
        if (!$this->stockLanternes->contains($stockLanterne)) {
            $this->stockLanternes->add($stockLanterne);
            $stockLanterne->setStockArticleSn($this);
        }

        return $this;
    }

    public function removeStockLanterne(StockLanterne $stockLanterne): static
    {
        if ($this->stockLanternes->removeElement($stockLanterne)) {
            // set the owning side to null (unless already changed)
            if ($stockLanterne->getStockArticleSn() === $this) {
                $stockLanterne->setStockArticleSn(null);
            }
        }

        return $this;
    }
}
