<?php

namespace App\Entity\Asc;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Stock\StockArticle;
use App\Repository\Asc\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
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
    private $refArticle;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $libArticle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descCourte;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descLongue;

    /**
     * @ORM\OneToMany(targetEntity=StocksArticles::class, mappedBy="article", orphanRemoval=true)
     */
    private $stocksArticles;

    /**
     * @ORM\ManyToOne(targetEntity=FruitDeMer::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fruitDeMer;

    /**
     * @ORM\OneToMany(targetEntity=StockArticle::class, mappedBy="article", orphanRemoval=true)
     */
    private $stockArticles;

    public function __construct()
    {
        $this->stocksArticles = new ArrayCollection();
        $this->stockArticles = new ArrayCollection();
    }
    public function initArticle(FruitDeMer $fruitDeMer, string $refArticle, string $libArticle, ?string $descCourte, ?string $descLongue)
    {
        $this->fruitDeMer = $fruitDeMer;
        $this->refArticle = $refArticle;
        $this->libArticle = $libArticle;
        $this->descCourte = $descCourte;
        $this->descLongue = $descLongue;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefArticle(): ?string
    {
        return $this->refArticle;
    }

    public function setRefArticle(string $refArticle): self
    {
        $this->refArticle = $refArticle;

        return $this;
    }

    public function getLibArticle(): ?string
    {
        return $this->libArticle;
    }

    public function setLibArticle(string $libArticle): self
    {
        $this->libArticle = $libArticle;

        return $this;
    }

    public function getDescCourte(): ?string
    {
        return $this->descCourte;
    }

    public function setDescCourte(?string $descCourte): self
    {
        $this->descCourte = $descCourte;

        return $this;
    }

    public function getDescLongue(): ?string
    {
        return $this->descLongue;
    }

    public function setDescLongue(?string $descLongue): self
    {
        $this->descLongue = $descLongue;

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
            $stocksArticle->setArticle($this);
        }

        return $this;
    }

    public function removeStocksArticle(StocksArticles $stocksArticle): self
    {
        if ($this->stocksArticles->removeElement($stocksArticle)) {
            // set the owning side to null (unless already changed)
            if ($stocksArticle->getArticle() === $this) {
                $stocksArticle->setArticle(null);
            }
        }

        return $this;
    }

    public function getFruitDeMer(): ?FruitDeMer
    {
        return $this->fruitDeMer;
    }

    public function setFruitDeMer(?FruitDeMer $fruitDeMer): self
    {
        $this->fruitDeMer = $fruitDeMer;

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
            $stockArticle->setArticle($this);
        }

        return $this;
    }

    public function removeStockArticle(StockArticle $stockArticle): self
    {
        if ($this->stockArticles->removeElement($stockArticle)) {
            // set the owning side to null (unless already changed)
            if ($stockArticle->getArticle() === $this) {
                $stockArticle->setArticle(null);
            }
        }

        return $this;
    }
}
