<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StocksCordes
 *
 * @ORM\Table(name="stocks_cordes", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_35E2087DC4598A51", columns={"emplacement_id"})}, indexes={@ORM\Index(name="IDX_35E2087DF9182269", columns={"corde_id"}), @ORM\Index(name="IDX_35E2087DA55629DC", columns={"processus_id"}), @ORM\Index(name="IDX_35E2087D3FCC49A5565B809", columns={"ref_stock_article", "numero_serie"}), @ORM\Index(name="IDX_35E2087D880E0320", columns={"doc_line"})})
 * @ORM\Entity
 */
class StocksCordes
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
     * @var int
     *
     * @ORM\Column(name="quantiter", type="integer", nullable=false)
     */
    private $quantiter;

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateAssemblage", type="date", nullable=true)
     */
    private $dateassemblage;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateChaussement", type="date", nullable=true)
     */
    private $datechaussement;

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
     * @var \Corde
     *
     * @ORM\ManyToOne(targetEntity="Corde")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="corde_id", referencedColumnName="id")
     * })
     */
    private $corde;

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
     * @var \Processus
     *
     * @ORM\ManyToOne(targetEntity="Processus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="processus_id", referencedColumnName="id")
     * })
     */
    private $processus;

    /**
     * @var \Emplacement
     *
     * @ORM\ManyToOne(targetEntity="Emplacement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emplacement_id", referencedColumnName="id")
     * })
     */
    private $emplacement;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateassemblage(): ?\DateTimeInterface
    {
        return $this->dateassemblage;
    }

    public function setDateassemblage(?\DateTimeInterface $dateassemblage): self
    {
        $this->dateassemblage = $dateassemblage;

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

    public function getDocLine(): ?DocsLines
    {
        return $this->docLine;
    }

    public function setDocLine(?DocsLines $docLine): self
    {
        $this->docLine = $docLine;

        return $this;
    }

    public function getCorde(): ?Corde
    {
        return $this->corde;
    }

    public function setCorde(?Corde $corde): self
    {
        $this->corde = $corde;

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

    public function getProcessus(): ?Processus
    {
        return $this->processus;
    }

    public function setProcessus(?Processus $processus): self
    {
        $this->processus = $processus;

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


}
