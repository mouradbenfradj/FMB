<?php

namespace App\Entity\Asc\Stock;

use App\Entity\Asc\Articles;
use App\Entity\Asc\Stock\Stock;
use App\Repository\Asc\Stock\StockArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockArticleRepository::class)
 */
class StockArticle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiter;

    /**
     * @ORM\ManyToOne(targetEntity=Stock::class, inversedBy="stockArticles")
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity=Articles::class, inversedBy="stockArticles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity=StockArticleSn::class, mappedBy="stockArticle", orphanRemoval=true)
     */
    private $stockArticleSns;

    public function __construct()
    {
        $this->stockArticleSns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiter(): ?int
    {
        return $this->quantiter;
    }

    public function setQuantiter(int $quantiter): self
    {
        $this->quantiter = $quantiter;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getArticle(): ?Articles
    {
        return $this->article;
    }

    public function setArticle(?Articles $article): self
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @return Collection<int, StockArticleSn>
     */
    public function getStockArticleSns(): Collection
    {
        return $this->stockArticleSns;
    }

    public function addStockArticleSn(StockArticleSn $stockArticleSn): self
    {
        if (!$this->stockArticleSns->contains($stockArticleSn)) {
            $this->stockArticleSns[] = $stockArticleSn;
            $stockArticleSn->setStockArticle($this);
        }

        return $this;
    }

    public function removeStockArticleSn(StockArticleSn $stockArticleSn): self
    {
        if ($this->stockArticleSns->removeElement($stockArticleSn)) {
            // set the owning side to null (unless already changed)
            if ($stockArticleSn->getStockArticle() === $this) {
                $stockArticleSn->setStockArticle(null);
            }
        }

        return $this;
    }
}
