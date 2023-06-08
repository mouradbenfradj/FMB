<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * StocksArticlesSn
 *
 * @ORM\Table(name="stocks_articles_sn", indexes={@ORM\Index(name="numero_serie", columns={"numero_serie"}), @ORM\Index(name="ref_stock_article", columns={"ref_stock_article"})})
 * @ORM\Entity
 */
class StocksArticlesSn
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero_serie", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $numeroSerie;

    /**
     * @var float
     *
     * @ORM\Column(name="sn_qte", type="float", precision=10, scale=0, nullable=false)
     */
    private $snQte;

    /**
     * @var \StocksArticles
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="StocksArticles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_stock_article", referencedColumnName="ref_stock_article")
     * })
     */
    private $refStockArticle;

    public function getNumeroSerie(): ?string
    {
        return $this->numeroSerie;
    }

    public function getSnQte(): ?float
    {
        return $this->snQte;
    }

    public function setSnQte(float $snQte): self
    {
        $this->snQte = $snQte;

        return $this;
    }

    public function getRefStockArticle(): ?StocksArticles
    {
        return $this->refStockArticle;
    }

    public function setRefStockArticle(?StocksArticles $refStockArticle): self
    {
        $this->refStockArticle = $refStockArticle;

        return $this;
    }


}
