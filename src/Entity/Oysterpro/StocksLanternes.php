<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * StocksLanternes
 *
 * @ORM\Table(name="stocks_lanternes", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_675D3C91C4598A51", columns={"emplacement_id"})}, indexes={@ORM\Index(name="IDX_675D3C913FCC49A5565B809", columns={"ref_stock_article", "numero_serie"}), @ORM\Index(name="IDX_675D3C91880E0320", columns={"doc_line"}), @ORM\Index(name="IDX_675D3C919F4902B6", columns={"lanterne_id"}), @ORM\Index(name="IDX_675D3C91A55629DC", columns={"processus_id"})})
 * @ORM\Entity
 */
class StocksLanternes
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
     * @var bool
     *
     * @ORM\Column(name="pret", type="boolean", nullable=false)
     */
    private $pret;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeCreation", type="date", nullable=false)
     */
    private $datedecreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateDeRetirement", type="date", nullable=true)
     */
    private $datederetirement;

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
     * @ORM\Column(name="date_de_mise_a_eau", type="date", nullable=true)
     */
    private $dateDeMiseAEau;

    /**
     * @var bool
     *
     * @ORM\Column(name="chaussement", type="boolean", nullable=false)
     */
    private $chaussement;

    /**
     * @var int
     *
     * @ORM\Column(name="cycle_r", type="integer", nullable=false)
     */
    private $cycleR;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateChaussement", type="date", nullable=true)
     */
    private $datechaussement;

    /**
     * @var \Processus
     *
     * @ORM\ManyToOne(targetEntity="Processus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="processus_id", referencedColumnName="id")
     * })
     */
    private $processus;

    /**
     * @var \DocsLines
     *
     * @ORM\ManyToOne(targetEntity="DocsLines")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="doc_line", referencedColumnName="ref_doc_line")
     * })
     */
    private $docLine;

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
     * @var \StocksArticlesSn
     *
     * @ORM\ManyToOne(targetEntity="StocksArticlesSn")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_stock_article", referencedColumnName="ref_stock_article"),
     *   @ORM\JoinColumn(name="numero_serie", referencedColumnName="numero_serie")
     * })
     */
    private $refStockArticle;

    /**
     * @var \Lanterne
     *
     * @ORM\ManyToOne(targetEntity="Lanterne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lanterne_id", referencedColumnName="nomLanterne")
     * })
     */
    private $lanterne;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDatedecreation(): ?\DateTimeInterface
    {
        return $this->datedecreation;
    }

    public function setDatedecreation(\DateTimeInterface $datedecreation): self
    {
        $this->datedecreation = $datedecreation;

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

    public function getDateDeMiseAEau(): ?\DateTimeInterface
    {
        return $this->dateDeMiseAEau;
    }

    public function setDateDeMiseAEau(?\DateTimeInterface $dateDeMiseAEau): self
    {
        $this->dateDeMiseAEau = $dateDeMiseAEau;

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

    public function getCycleR(): ?int
    {
        return $this->cycleR;
    }

    public function setCycleR(int $cycleR): self
    {
        $this->cycleR = $cycleR;

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

    public function getProcessus(): ?Processus
    {
        return $this->processus;
    }

    public function setProcessus(?Processus $processus): self
    {
        $this->processus = $processus;

        return $this;
    }

    public function getDocLine(): ?DocsLines
    {
        return $this->docLine;
    }

    public function setDocLine(?DocsLines $docLine): self
    {
        $this->docLine = $docLine;

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

    public function getRefStockArticle(): ?StocksArticlesSn
    {
        return $this->refStockArticle;
    }

    public function setRefStockArticle(?StocksArticlesSn $refStockArticle): self
    {
        $this->refStockArticle = $refStockArticle;

        return $this;
    }

    public function getLanterne(): ?Lanterne
    {
        return $this->lanterne;
    }

    public function setLanterne(?Lanterne $lanterne): self
    {
        $this->lanterne = $lanterne;

        return $this;
    }


}
