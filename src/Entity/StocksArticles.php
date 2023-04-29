<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StocksArticles
 *
 * @ORM\Table(name="stocks_articles", indexes={@ORM\Index(name="id_stock", columns={"id_stock"}), @ORM\Index(name="ref_article", columns={"ref_article"})})
 * @ORM\Entity(repositoryClass="App\Repository\StocksArticlesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class StocksArticles
{
    /**
     * @var float
     *
     * @ORM\Column(name="qte", type="float", precision=10, scale=0, nullable=false)
     */
    private $qte;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_stock_article", type="string", length=32)
     * @ORM\Id
     */
    private $refStockArticle;

    /**
     * @var \App\Entity\Articles
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_article", referencedColumnName="ref_article")
     * })
     */
    private $refArticle;

    /**
     * @var \App\Entity\Stocks
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Stocks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_stock", referencedColumnName="id_stock")
     * })
     */
    private $idStock;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StocksArticlesSn", mappedBy="refStockArticle" ,cascade={"persist","remove"})
     */
    private $stocksArticlesSn;

    public function __toString()
    {
        return $this->refStockArticle;
    }

    /**
     * Set qte
     *
     * @param float $qte
     * @return StocksArticles
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return float
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Get refStockArticle
     *
     * @return string
     */
    public function getRefStockArticle()
    {
        return $this->refStockArticle;
    }
    /**
     * @ORM\PrePersist
     */
    public function geerateRefStockArticle()
    {
        $this->refStockArticle = uniqid();
    }
    /**
     * Set refArticle
     *
     * @param \App\Entity\Articles $refArticle
     * @return StocksArticles
     */
    public function setRefArticle(\App\Entity\Articles $refArticle = null)
    {
        $this->refArticle = $refArticle;

        return $this;
    }

    /**
     * Get refArticle
     *
     * @return \App\Entity\Articles
     */
    public function getRefArticle()
    {
        return $this->refArticle;
    }

    /**
     * Set idStock
     *
     * @param \App\Entity\Stocks $idStock
     * @return StocksArticles
     */
    public function setIdStock(\App\Entity\Stocks $idStock = null)
    {
        $this->idStock = $idStock;

        return $this;
    }

    /**
     * Get idStock
     *
     * @return \App\Entity\Stocks
     */
    public function getIdStock()
    {
        return $this->idStock;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stocksArticlesSn = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add stocksArticlesSn
     *
     * @param \App\Entity\StocksArticlesSn $stocksArticlesSn
     * @return StocksArticles
     */
    public function addStocksArticlesSn(\App\Entity\StocksArticlesSn $stocksArticlesSn)
    {
        $this->stocksArticlesSn[] = $stocksArticlesSn;
        $stocksArticlesSn->setRefStockArticle($this);
        return $this;
    }

    /**
     * Remove stocksArticlesSn
     *
     * @param \App\Entity\StocksArticlesSn $stocksArticlesSn
     */
    public function removeStocksArticlesSn(\App\Entity\StocksArticlesSn $stocksArticlesSn)
    {
        $this->stocksArticlesSn->removeElement($stocksArticlesSn);
    }

    /**
     * Get stocksArticlesSn
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStocksArticlesSn()
    {
        return $this->stocksArticlesSn;
    }
}