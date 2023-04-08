<?php

namespace OysterPro28Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emballage
 *
 * @ORM\Table()
 */
class Emballage
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
     * @var \OysterPro28Bundle\Entity\StocksArticles
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="OysterPro28Bundle\Entity\StocksArticles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_stock_article", referencedColumnName="ref_stock_article")
     * })
     */
    private $refStockArticle;
    /**
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\Processus")
     * @ORM\JoinColumn(nullable=true)
     */
    private $processus;

    /**
     * @ORM\OneToMany(targetEntity="OysterPro28Bundle\Entity\EmballageContent", mappedBy="emballage",cascade={"persist","remove"},fetch="LAZY")
     */
    private $emballageContent;

    /**
     * @ORM\OneToOne(targetEntity="OysterPro28Bundle\Entity\Emplacement", mappedBy="stockslanterne",fetch="LAZY")
     * @ORM\JoinColumn(nullable=true)
     */
    private $emplacement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pret", type="boolean")
     */
    private $pret =false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="chaussement", type="boolean")
     */
    private $chaussement =false;

    /**
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\StocksArticlesSn")
     * @Orm\JoinColumns({  @ORM\JoinColumn(name="ref_stock_article", referencedColumnName="ref_stock_article"),@Orm\JoinColumn(name="numero_serie", referencedColumnName="numero_serie")} )
     */
    private $article;
    /**
     * @var string
     *
     * @ORM\Column(name="numero_serie", type="string", length=32)
     */
    private $numeroSerie;
    /**
     *
     * @ORM\Column(name="dateDeCreation", type="date")
     */
    private $dateDeCreation;
    /**
     *
     * @ORM\Column(name="date_de_mise_a_eau", type="date",nullable=true)
     */
    private $dateDeMiseAEau;
    /**
     *
     * @ORM\Column(name="dateDeRetraitTransfert", type="date", nullable=true)
     */
    private $dateDeRetraitTransfert;
    /**
     *
     * @ORM\Column(name="dateDeMAETransfert", type="date", nullable=true)
     */
    private $dateDeMAETransfert;
    /**
     *
     * @ORM\Column(name="dateDeRetirement", type="date", nullable=true)
     */
    private $dateDeRetirement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateChaussement", type="date",nullable=true)
     */
    private $dateChaussement;
    /**
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\DocsLines")
     * @ORM\JoinColumn(name="doc_line", referencedColumnName="ref_doc_line")
     */
    private $docLine;
    /**
     * @var integer
     *
     * @ORM\Column(name="cycle_r", type="integer")
     */
    private $cycleR = 0;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->emballageContent = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return "" . $this->id;
    }

}
