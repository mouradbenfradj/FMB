<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StocksArticlesSnVirtuel
 *
 * @ORM\Table(name="stocks_articles_sn_virtuel", indexes={@ORM\Index(name="numero_serie", columns={"numero_serie"}), @ORM\Index(name="ref_stock_article", columns={"ref_stock_article"})})
 * @ORM\Entity
 */
class StocksArticlesSnVirtuel
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
     * @var float|null
     *
     * @ORM\Column(name="sn_qte_morte", type="float", precision=10, scale=0, nullable=true)
     */
    private $snQteMorte;

    /**
     * @var float|null
     *
     * @ORM\Column(name="sn_qte_perdu", type="float", precision=10, scale=0, nullable=true)
     */
    private $snQtePerdu;

    /**
     * @var float|null
     *
     * @ORM\Column(name="sn_qte_traiter", type="float", precision=10, scale=0, nullable=true)
     */
    private $snQteTraiter;

    /**
     * @var float|null
     *
     * @ORM\Column(name="sn_qte_mise_en_vente", type="float", precision=10, scale=0, nullable=true)
     */
    private $snQteMiseEnVente;

    /**
     * @var float|null
     *
     * @ORM\Column(name="sn_qte_a_remettre_en_poche", type="float", precision=10, scale=0, nullable=true)
     */
    private $snQteARemettreEnPoche;

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

    public function getSnQteMorte(): ?float
    {
        return $this->snQteMorte;
    }

    public function setSnQteMorte(?float $snQteMorte): self
    {
        $this->snQteMorte = $snQteMorte;

        return $this;
    }

    public function getSnQtePerdu(): ?float
    {
        return $this->snQtePerdu;
    }

    public function setSnQtePerdu(?float $snQtePerdu): self
    {
        $this->snQtePerdu = $snQtePerdu;

        return $this;
    }

    public function getSnQteTraiter(): ?float
    {
        return $this->snQteTraiter;
    }

    public function setSnQteTraiter(?float $snQteTraiter): self
    {
        $this->snQteTraiter = $snQteTraiter;

        return $this;
    }

    public function getSnQteMiseEnVente(): ?float
    {
        return $this->snQteMiseEnVente;
    }

    public function setSnQteMiseEnVente(?float $snQteMiseEnVente): self
    {
        $this->snQteMiseEnVente = $snQteMiseEnVente;

        return $this;
    }

    public function getSnQteARemettreEnPoche(): ?float
    {
        return $this->snQteARemettreEnPoche;
    }

    public function setSnQteARemettreEnPoche(?float $snQteARemettreEnPoche): self
    {
        $this->snQteARemettreEnPoche = $snQteARemettreEnPoche;

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
