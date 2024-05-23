<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emballage
 *
 * @ORM\Table(name="emballage", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_17D1FF4BC4598A51", columns={"emplacement_id"})}, indexes={@ORM\Index(name="IDX_17D1FF4B3FCC49A5", columns={"ref_stock_article"}), @ORM\Index(name="IDX_17D1FF4B5A633396565B809", columns={"ref_stock_article_sn", "numero_serie"}), @ORM\Index(name="IDX_17D1FF4B727ACA70", columns={"parent_id"}), @ORM\Index(name="IDX_17D1FF4BA55629DC", columns={"processus_id"})})
 * @ORM\Entity
 */
class Emballage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="doc_line", type="string", length=32, nullable=true)
     */
    private $docLine;

    /**
     * @var bool
     *
     * @ORM\Column(name="pret", type="boolean", nullable=false)
     */
    private $pret;

    /**
     * @var bool
     *
     * @ORM\Column(name="chaussement", type="boolean", nullable=false)
     */
    private $chaussement;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateAssemblage", type="date", nullable=true)
     */
    private $dateassemblage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeCreation", type="date", nullable=false)
     */
    private $datedecreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_de_mise_a_eau", type="date", nullable=true)
     */
    private $dateDeMiseAEau;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateDeRetraitTransfert", type="date", nullable=true)
     */
    private $datederetraittransfert;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateDeMAETransfert", type="date", nullable=true)
     */
    private $datedemaetransfert;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateDeRetirement", type="date", nullable=true)
     */
    private $datederetirement;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateChaussement", type="date", nullable=true)
     */
    private $datechaussement;

    /**
     * @var int
     *
     * @ORM\Column(name="cycle_r", type="integer", nullable=false)
     */
    private $cycleR;

    /**
     * @var \Emplacement
     *
     * @ORM\ManyToOne(targetEntity="Emplacement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emplacement_id", referencedColumnName="id")
     * })
     */
    private $emplacement;

    /**
     * @var \StocksArticles
     *
     * @ORM\ManyToOne(targetEntity="StocksArticles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_stock_article", referencedColumnName="ref_stock_article")
     * })
     */
    private $refStockArticle;

    /**
     * @var \Emballage
     *
     * @ORM\ManyToOne(targetEntity="Emballage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \StocksArticlesSn
     *
     * @ORM\ManyToOne(targetEntity="StocksArticlesSn")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_stock_article_sn", referencedColumnName="ref_stock_article"),
     *   @ORM\JoinColumn(name="numero_serie", referencedColumnName="numero_serie")
     * })
     */
    private $refStockArticleSn;

    /**
     * @var \Processus
     *
     * @ORM\ManyToOne(targetEntity="Processus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="processus_id", referencedColumnName="id")
     * })
     */
    private $processus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDocLine(): ?string
    {
        return $this->docLine;
    }

    public function setDocLine(?string $docLine): self
    {
        $this->docLine = $docLine;

        return $this;
    }

    public function isPret(): ?bool
    {
        return $this->pret;
    }

    public function setPret(bool $pret): self
    {
        $this->pret = $pret;

        return $this;
    }

    public function isChaussement(): ?bool
    {
        return $this->chaussement;
    }

    public function setChaussement(bool $chaussement): self
    {
        $this->chaussement = $chaussement;

        return $this;
    }

    public function getDateassemblage(): ?\DateTimeInterface
    {
        return $this->dateassemblage;
    }

    public function setDateassemblage(?\DateTimeInterface $dateassemblage): self
    {
        $this->dateassemblage = $dateassemblage;

        return $this;
    }

    public function getDatedecreation(): ?\DateTimeInterface
    {
        return $this->datedecreation;
    }

    public function setDatedecreation(\DateTimeInterface $datedecreation): self
    {
        $this->datedecreation = $datedecreation;

        return $this;
    }

    public function getDateDeMiseAEau(): ?\DateTimeInterface
    {
        return $this->dateDeMiseAEau;
    }

    public function setDateDeMiseAEau(?\DateTimeInterface $dateDeMiseAEau): self
    {
        $this->dateDeMiseAEau = $dateDeMiseAEau;

        return $this;
    }

    public function getDatederetraittransfert(): ?\DateTimeInterface
    {
        return $this->datederetraittransfert;
    }

    public function setDatederetraittransfert(?\DateTimeInterface $datederetraittransfert): self
    {
        $this->datederetraittransfert = $datederetraittransfert;

        return $this;
    }

    public function getDatedemaetransfert(): ?\DateTimeInterface
    {
        return $this->datedemaetransfert;
    }

    public function setDatedemaetransfert(?\DateTimeInterface $datedemaetransfert): self
    {
        $this->datedemaetransfert = $datedemaetransfert;

        return $this;
    }

    public function getDatederetirement(): ?\DateTimeInterface
    {
        return $this->datederetirement;
    }

    public function setDatederetirement(?\DateTimeInterface $datederetirement): self
    {
        $this->datederetirement = $datederetirement;

        return $this;
    }

    public function getDatechaussement(): ?\DateTimeInterface
    {
        return $this->datechaussement;
    }

    public function setDatechaussement(?\DateTimeInterface $datechaussement): self
    {
        $this->datechaussement = $datechaussement;

        return $this;
    }

    public function getCycleR(): ?int
    {
        return $this->cycleR;
    }

    public function setCycleR(int $cycleR): self
    {
        $this->cycleR = $cycleR;

        return $this;
    }

    public function getEmplacement(): ?Emplacement
    {
        return $this->emplacement;
    }

    public function setEmplacement(?Emplacement $emplacement): self
    {
        $this->emplacement = $emplacement;

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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getRefStockArticleSn(): ?StocksArticlesSn
    {
        return $this->refStockArticleSn;
    }

    public function setRefStockArticleSn(?StocksArticlesSn $refStockArticleSn): self
    {
        $this->refStockArticleSn = $refStockArticleSn;

        return $this;
    }

    public function getProcessus(): ?Processus
    {
        return $this->processus;
    }

    public function setProcessus(?Processus $processus): self
    {
        $this->processus = $processus;

        return $this;
    }


}
