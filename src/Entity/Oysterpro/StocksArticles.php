<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * StocksArticles
 *
 * @ORM\Table(name="stocks_articles", indexes={@ORM\Index(name="id_stock", columns={"id_stock"}), @ORM\Index(name="ref_article", columns={"ref_article"})})
 * @ORM\Entity
 */
class StocksArticles
{
    /**
     * @var string
     *
     * @ORM\Column(name="ref_stock_article", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $refStockArticle;

    /**
     * @var float
     *
     * @ORM\Column(name="qte", type="float", precision=10, scale=0, nullable=false)
     */
    private $qte;

    /**
     * @var \Stocks
     *
     * @ORM\ManyToOne(targetEntity="Stocks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_stock", referencedColumnName="id_stock")
     * })
     */
    private $idStock;

    /**
     * @var \Articles
     *
     * @ORM\ManyToOne(targetEntity="Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_article", referencedColumnName="ref_article")
     * })
     */
    private $refArticle;

    public function getRefStockArticle(): ?string
    {
        return $this->refStockArticle;
    }

    public function getQte(): ?float
    {
        return $this->qte;
    }

    public function setQte(float $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getIdStock(): ?Stocks
    {
        return $this->idStock;
    }

    public function setIdStock(?Stocks $idStock): self
    {
        $this->idStock = $idStock;

        return $this;
    }

    public function getRefArticle(): ?Articles
    {
        return $this->refArticle;
    }

    public function setRefArticle(?Articles $refArticle): self
    {
        $this->refArticle = $refArticle;

        return $this;
    }


}
