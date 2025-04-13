<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $refArticle = null;

    #[ORM\Column(length: 250)]
    private ?string $libArticle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descCourte = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descLongue = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FruitDeMer $fruitDeMer = null;

    /**
     * @var Collection<int, StockArticle>
     */
    #[ORM\OneToMany(targetEntity: StockArticle::class, mappedBy: 'articles', orphanRemoval: true)]
    private Collection $stockArticles;

    public function __toString() //TODO : voir une autre solution
    {
        return $this->libArticle . ' ' . $this->fruitDeMer->getNom();
    }
    public function __construct()
    {
        $this->stockArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefArticle(): ?string
    {
        return $this->refArticle;
    }

    public function setRefArticle(string $refArticle): static
    {
        $this->refArticle = $refArticle;

        return $this;
    }

    public function getLibArticle(): ?string
    {
        return $this->libArticle;
    }

    public function setLibArticle(string $libArticle): static
    {
        $this->libArticle = $libArticle;

        return $this;
    }

    public function getDescCourte(): ?string
    {
        return $this->descCourte;
    }

    public function setDescCourte(?string $descCourte): static
    {
        $this->descCourte = $descCourte;

        return $this;
    }

    public function getDescLongue(): ?string
    {
        return $this->descLongue;
    }

    public function setDescLongue(?string $descLongue): static
    {
        $this->descLongue = $descLongue;

        return $this;
    }

    public function getFruitDeMer(): ?FruitDeMer
    {
        return $this->fruitDeMer;
    }

    public function setFruitDeMer(?FruitDeMer $fruitDeMer): static
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

    public function addStockArticle(StockArticle $stockArticle): static
    {
        if (!$this->stockArticles->contains($stockArticle)) {
            $this->stockArticles->add($stockArticle);
            $stockArticle->setArticles($this);
        }

        return $this;
    }

    public function removeStockArticle(StockArticle $stockArticle): static
    {
        if ($this->stockArticles->removeElement($stockArticle)) {
            // set the owning side to null (unless already changed)
            if ($stockArticle->getArticles() === $this) {
                $stockArticle->setArticles(null);
            }
        }

        return $this;
    }
}
