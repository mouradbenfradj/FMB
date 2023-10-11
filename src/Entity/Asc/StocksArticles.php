<?php

namespace App\Entity\Asc;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Asc\StocksArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StocksArticlesRepository::class)
 */
class StocksArticles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Articles::class, inversedBy="stocksArticles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity=Stock::class, inversedBy="stocksArticles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiter;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
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
}
