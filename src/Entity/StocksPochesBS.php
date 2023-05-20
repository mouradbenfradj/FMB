<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StocksPochesBS
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\StocksPochesBSRepository")
 */
class StocksPochesBS
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PochesBS", inversedBy="stockspoches",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,  referencedColumnName="id")
     */
    private $pochesbs;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Processus")
     * @ORM\JoinColumn(nullable=true)
     */
    private $processus;
    /**
     * @var integer
     *
     * @ORM\Column(name="quantiter", type="integer")
     */
    private $quantiter;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pret", type="boolean")
     */
    private $pret;

    /**
     * @var boolean
     *
     * @ORM\Column(name="chaussement", type="boolean")
     */
    private $chaussement = false;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StocksArticlesSn")
     * @Orm\JoinColumns({  @ORM\JoinColumn(name="ref_stock_article", referencedColumnName="ref_stock_article"),@Orm\JoinColumn(name="numero_serie", referencedColumnName="numero_serie")} )
     */
    private $article;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeCreation", type="date")
     */
    private $dateDeCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeMiseAEau", type="date",nullable=true)
     */
    private $dateDeMiseAEau;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeRetraitTransfert", type="date",nullable=true)
     */
    private $dateDeRetraitTransfert;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeMAETransfert", type="date",nullable=true)
     */
    private $dateDeMAETransfert;
    /**
     *
     * @ORM\Column(name="dateAssemblage", type="date", nullable=true)
     */
    private $dateAssemblage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeRetirement", type="date",nullable=true)
     */
    private $dateDeRetirement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateChaussement", type="date",nullable=true)
     */
    private $dateChaussement;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Emplacement", mappedBy="stockspoches")
     * @ORM\JoinColumn(nullable=true)
     */
    private $emplacement;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StocksCordes", inversedBy="pocheAssemblage")
     * @ORM\JoinColumn(nullable=true)
     */
    private $cordeAssemblage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DocsLines")
     * @ORM\JoinColumn(name="doc_line", referencedColumnName="ref_doc_line")
     */
    private $docLine;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return '' . $this->getId();
    }

    /**
     * Set quantiter
     *
     * @param integer $quantiter
     * @return StocksPochesBS
     */
    public function setQuantiter($quantiter)
    {
        $this->quantiter = $quantiter;

        return $this;
    }

    /**
     * Get quantiter
     *
     * @return integer
     */
    public function getQuantiter()
    {
        return $this->quantiter;
    }

    /**
     * Set pret
     *
     * @param boolean $pret
     * @return StocksPochesBS
     */
    public function setPret($pret)
    {
        $this->pret = $pret;

        return $this;
    }

    /**
     * Get pret
     *
     * @return boolean
     */
    public function getPret()
    {
        return $this->pret;
    }

    /**
     * Set numeroSerie
     *
     * @param string $numeroSerie
     * @return StocksPochesBS
     */
    public function setNumeroSerie($numeroSerie)
    {
        $this->numeroSerie = $numeroSerie;

        return $this;
    }

    /**
     * Get numeroSerie
     *
     * @return string
     */
    public function getNumeroSerie()
    {
        return $this->numeroSerie;
    }

    /**
     * Set dateDeCreation
     *
     * @param \DateTime $dateDeCreation
     * @return StocksPochesBS
     */
    public function setDateDeCreation($dateDeCreation)
    {
        $this->dateDeCreation = $dateDeCreation;

        return $this;
    }

    /**
     * Get dateDeCreation
     *
     * @return \DateTime
     */
    public function getDateDeCreation()
    {
        return $this->dateDeCreation;
    }

    /**
     * Set dateDeMiseAEau
     *
     * @param \DateTime $dateDeMiseAEau
     * @return StocksPochesBS
     */
    public function setDateDeMiseAEau($dateDeMiseAEau)
    {
        $this->dateDeMiseAEau = $dateDeMiseAEau;

        return $this;
    }

    /**
     * Get dateDeMiseAEau
     *
     * @return \DateTime
     */
    public function getDateDeMiseAEau()
    {
        return $this->dateDeMiseAEau;
    }

    /**
     * Set dateDeRetraitTransfert
     *
     * @param \DateTime $dateDeRetraitTransfert
     * @return StocksPochesBS
     */
    public function setDateDeRetraitTransfert($dateDeRetraitTransfert)
    {
        $this->dateDeRetraitTransfert = $dateDeRetraitTransfert;

        return $this;
    }

    /**
     * Get dateDeRetraitTransfert
     *
     * @return \DateTime
     */
    public function getDateDeRetraitTransfert()
    {
        return $this->dateDeRetraitTransfert;
    }

    /**
     * Set dateDeMAETransfert
     *
     * @param \DateTime $dateDeMAETransfert
     * @return StocksPochesBS
     */
    public function setDateDeMAETransfert($dateDeMAETransfert)
    {
        $this->dateDeMAETransfert = $dateDeMAETransfert;

        return $this;
    }

    /**
     * Get dateDeMAETransfert
     *
     * @return \DateTime
     */
    public function getDateDeMAETransfert()
    {
        return $this->dateDeMAETransfert;
    }

    /**
     * Set dateDeRetirement
     *
     * @param \DateTime $dateDeRetirement
     * @return StocksPochesBS
     */
    public function setDateDeRetirement($dateDeRetirement)
    {
        $this->dateDeRetirement = $dateDeRetirement;

        return $this;
    }

    /**
     * Get dateDeRetirement
     *
     * @return \DateTime
     */
    public function getDateDeRetirement()
    {
        return $this->dateDeRetirement;
    }

    /**
     * Set pochesbs
     *
     * @param \App\Entity\PochesBS $pochesbs
     * @return StocksPochesBS
     */
    public function setPochesbs(\App\Entity\PochesBS $pochesbs)
    {
        $this->pochesbs = $pochesbs;

        return $this;
    }

    /**
     * Get pochesbs
     *
     * @return \App\Entity\PochesBS
     */
    public function getPochesbs()
    {
        return $this->pochesbs;
    }

    /**
     * Set article
     *
     * @param \App\Entity\StocksArticlesSn $article
     * @return StocksPochesBS
     */
    public function setArticle(\App\Entity\StocksArticlesSn $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \App\Entity\StocksArticlesSn
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set emplacement
     *
     * @param \App\Entity\Emplacement $emplacement
     * @return StocksPochesBS
     */
    public function setEmplacement(\App\Entity\Emplacement $emplacement = null)
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    /**
     * Get emplacement
     *
     * @return \App\Entity\Emplacement
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * Set docLine
     *
     * @param \App\Entity\DocsLines $docLine
     * @return StocksPochesBS
     */
    public function setDocLine(\App\Entity\DocsLines $docLine = null)
    {
        $this->docLine = $docLine;

        return $this;
    }

    /**
     * Get docLine
     *
     * @return \App\Entity\DocsLines
     */
    public function getDocLine()
    {
        return $this->docLine;
    }

    /**
     * Set chaussement
     *
     * @param boolean $chaussement
     * @return StocksPochesBS
     */
    public function setChaussement($chaussement)
    {
        $this->chaussement = $chaussement;

        return $this;
    }

    /**
     * Get chaussement
     *
     * @return boolean
     */
    public function getChaussement()
    {
        return $this->chaussement;
    }

    /**
     * Set processus
     *
     * @param \App\Entity\Processus $processus
     * @return StocksPochesBS
     */
    public function setProcessus(\App\Entity\Processus $processus = null)
    {
        $this->processus = $processus;

        return $this;
    }

    /**
     * Get processus
     *
     * @return \App\Entity\Processus
     */
    public function getProcessus()
    {
        return $this->processus;
    }

    /**
     * Set dateAssemblage
     *
     * @param \DateTime $dateAssemblage
     * @return StocksPochesBS
     */
    public function setDateAssemblage($dateAssemblage)
    {
        $this->dateAssemblage = $dateAssemblage;

        return $this;
    }

    /**
     * Get dateAssemblage
     *
     * @return \DateTime
     */
    public function getDateAssemblage()
    {
        return $this->dateAssemblage;
    }

    /**
     * Set cordeAssemblage
     *
     * @param \App\Entity\StocksCordes $cordeAssemblage
     * @return StocksPochesBS
     */
    public function setCordeAssemblage(\App\Entity\StocksCordes $cordeAssemblage = null)
    {
        $this->cordeAssemblage = $cordeAssemblage;

        return $this;
    }

    /**
     * Get cordeAssemblage
     *
     * @return \App\Entity\StocksCordes
     */
    public function getCordeAssemblage()
    {
        return $this->cordeAssemblage;
    }

    /**
     * Set dateChaussement
     *
     * @param \DateTime $dateChaussement
     * @return StocksPochesBS
     */
    public function setDateChaussement($dateChaussement)
    {
        $this->dateChaussement = $dateChaussement;

        return $this;
    }

    /**
     * Get dateChaussement
     *
     * @return \DateTime
     */
    public function getDateChaussement()
    {
        return $this->dateChaussement;
    }

    public function compareAPoche($poche)
    {
        if (($this->getArticle() == $poche->getArticle()) &&
            ($this->getChaussement() == $poche->getChaussement())
            && ($this->getCordeAssemblage() == $poche->getCordeAssemblage())
            && ($this->getDateAssemblage() == $poche->getDateAssemblage())
            && ($this->getPochesbs() == $poche->getPochesbs())
            && ($this->getQuantiter() == $poche->getQuantiter())
        ) {
            return true;
        } else {
            return false;
        }

    }

    public function isPret(): ?bool
    {
        return $this->pret;
    }

    public function isChaussement(): ?bool
    {
        return $this->chaussement;
    }
}
