<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StockArticleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: StockArticleRepository::class)]
class StockArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = 0;

    #[ORM\ManyToOne(inversedBy: 'stockArticles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stock $stock = null;

    /**
     * @var Collection<int, StockArticleSn>
     */
    #[ORM\OneToMany(targetEntity: StockArticleSn::class, mappedBy: 'stockArticle', orphanRemoval: true, cascade: ['persist'])]
    private Collection $stockArticleSns;

    #[ORM\ManyToOne(inversedBy: 'stockArticles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Articles $articles = null;
    public function __toString()
    {
        return $this->articles->getLibArticle();
    }

    public function __construct()
    {
        $this->stockArticleSns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, StockArticleSn>
     */
    public function getStockArticleSns(): Collection
    {
        return $this->stockArticleSns;
    }

    public function addStockArticleSn(StockArticleSn $stockArticleSn): static
    {
        if (!$this->stockArticleSns->contains($stockArticleSn)) {
            $this->stockArticleSns->add($stockArticleSn);
            $stockArticleSn->setStockArticle($this);
        }

        return $this;
    }

    public function removeStockArticleSn(StockArticleSn $stockArticleSn): static
    {
        if ($this->stockArticleSns->removeElement($stockArticleSn)) {
            // set the owning side to null (unless already changed)
            if ($stockArticleSn->getStockArticle() === $this) {
                $stockArticleSn->setStockArticle(null);
            }
        }

        return $this;
    }

    public function getArticles(): ?Articles
    {
        return $this->articles;
    }

    public function setArticles(?Articles $articles): static
    {
        $this->articles = $articles;

        return $this;
    }
}
