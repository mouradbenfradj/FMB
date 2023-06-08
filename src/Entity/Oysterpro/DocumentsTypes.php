<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentsTypes
 *
 * @ORM\Table(name="documents_types", indexes={@ORM\Index(name="id_pdf_modele", columns={"id_pdf_modele"}), @ORM\Index(name="actif", columns={"actif"}), @ORM\Index(name="id_type_groupe", columns={"id_type_groupe"})})
 * @ORM\Entity
 */
class DocumentsTypes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_type_doc", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_type_doc", type="string", length=64, nullable=false)
     */
    private $libTypeDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_type_printed", type="string", length=64, nullable=false)
     */
    private $libTypePrinted;

    /**
     * @var string
     *
     * @ORM\Column(name="code_doc", type="string", length=32, nullable=false)
     */
    private $codeDoc;

    /**
     * @var bool
     *
     * @ORM\Column(name="id_type_groupe", type="boolean", nullable=false)
     */
    private $idTypeGroupe;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false)
     */
    private $actif;

    /**
     * @var \PdfModeles
     *
     * @ORM\ManyToOne(targetEntity="PdfModeles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pdf_modele", referencedColumnName="id_pdf_modele")
     * })
     */
    private $idPdfModele;

    public function getIdTypeDoc(): ?int
    {
        return $this->idTypeDoc;
    }

    public function getLibTypeDoc(): ?string
    {
        return $this->libTypeDoc;
    }

    public function setLibTypeDoc(string $libTypeDoc): self
    {
        $this->libTypeDoc = $libTypeDoc;

        return $this;
    }

    public function getLibTypePrinted(): ?string
    {
        return $this->libTypePrinted;
    }

    public function setLibTypePrinted(string $libTypePrinted): self
    {
        $this->libTypePrinted = $libTypePrinted;

        return $this;
    }

    public function getCodeDoc(): ?string
    {
        return $this->codeDoc;
    }

    public function setCodeDoc(string $codeDoc): self
    {
        $this->codeDoc = $codeDoc;

        return $this;
    }

    public function isIdTypeGroupe(): ?bool
    {
        return $this->idTypeGroupe;
    }

    public function setIdTypeGroupe(bool $idTypeGroupe): self
    {
        $this->idTypeGroupe = $idTypeGroupe;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getIdPdfModele(): ?PdfModeles
    {
        return $this->idPdfModele;
    }

    public function setIdPdfModele(?PdfModeles $idPdfModele): self
    {
        $this->idPdfModele = $idPdfModele;

        return $this;
    }


}
