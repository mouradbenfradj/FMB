<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocsLines
 *
 * @ORM\Table(name="docs_lines", indexes={@ORM\Index(name="ref_article", columns={"ref_article"}), @ORM\Index(name="ref_doc", columns={"ref_doc"}), @ORM\Index(name="ref_doc_line_parent", columns={"ref_doc_line_parent"})})
 * @ORM\Entity
 */
class DocsLines
{
    /**
     * @var string
     *
     * @ORM\Column(name="ref_doc_line", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $refDocLine;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ref_article", type="string", length=32, nullable=true)
     */
    private $refArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_article", type="string", length=250, nullable=false)
     */
    private $libArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_article", type="text", length=16777215, nullable=false)
     */
    private $descArticle;

    /**
     * @var float
     *
     * @ORM\Column(name="qte", type="float", precision=10, scale=0, nullable=false)
     */
    private $qte;

    /**
     * @var float
     *
     * @ORM\Column(name="pu_ht", type="float", precision=10, scale=0, nullable=false)
     */
    private $puHt;

    /**
     * @var float
     *
     * @ORM\Column(name="remise", type="float", precision=10, scale=0, nullable=false)
     */
    private $remise;

    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float", precision=10, scale=0, nullable=false)
     */
    private $tva;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="smallint", nullable=false)
     */
    private $ordre;

    /**
     * @var bool
     *
     * @ORM\Column(name="visible", type="boolean", nullable=false)
     */
    private $visible;

    /**
     * @var float|null
     *
     * @ORM\Column(name="pa_ht", type="float", precision=10, scale=0, nullable=true)
     */
    private $paHt;

    /**
     * @var bool
     *
     * @ORM\Column(name="pa_forced", type="boolean", nullable=false)
     */
    private $paForced;

    /**
     * @var \Documents
     *
     * @ORM\ManyToOne(targetEntity="Documents")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_doc", referencedColumnName="ref_doc")
     * })
     */
    private $refDoc;

    /**
     * @var \DocsLines
     *
     * @ORM\ManyToOne(targetEntity="DocsLines")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_doc_line_parent", referencedColumnName="ref_doc_line")
     * })
     */
    private $refDocLineParent;

    public function getRefDocLine(): ?string
    {
        return $this->refDocLine;
    }

    public function getRefArticle(): ?string
    {
        return $this->refArticle;
    }

    public function setRefArticle(?string $refArticle): self
    {
        $this->refArticle = $refArticle;

        return $this;
    }

    public function getLibArticle(): ?string
    {
        return $this->libArticle;
    }

    public function setLibArticle(string $libArticle): self
    {
        $this->libArticle = $libArticle;

        return $this;
    }

    public function getDescArticle(): ?string
    {
        return $this->descArticle;
    }

    public function setDescArticle(string $descArticle): self
    {
        $this->descArticle = $descArticle;

        return $this;
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

    public function getPuHt(): ?float
    {
        return $this->puHt;
    }

    public function setPuHt(float $puHt): self
    {
        $this->puHt = $puHt;

        return $this;
    }

    public function getRemise(): ?float
    {
        return $this->remise;
    }

    public function setRemise(float $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getPaHt(): ?float
    {
        return $this->paHt;
    }

    public function setPaHt(?float $paHt): self
    {
        $this->paHt = $paHt;

        return $this;
    }

    public function isPaForced(): ?bool
    {
        return $this->paForced;
    }

    public function setPaForced(bool $paForced): self
    {
        $this->paForced = $paForced;

        return $this;
    }

    public function getRefDoc(): ?Documents
    {
        return $this->refDoc;
    }

    public function setRefDoc(?Documents $refDoc): self
    {
        $this->refDoc = $refDoc;

        return $this;
    }

    public function getRefDocLineParent(): ?self
    {
        return $this->refDocLineParent;
    }

    public function setRefDocLineParent(?self $refDocLineParent): self
    {
        $this->refDocLineParent = $refDocLineParent;

        return $this;
    }


}
