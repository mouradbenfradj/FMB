<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * PdfModeles
 *
 * @ORM\Table(name="pdf_modeles", indexes={@ORM\Index(name="id_pdf_type", columns={"id_pdf_type"})})
 * @ORM\Entity
 */
class PdfModeles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pdf_modele", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPdfModele;

    /**
     * @var bool
     *
     * @ORM\Column(name="id_pdf_type", type="boolean", nullable=false)
     */
    private $idPdfType;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_modele", type="string", length=64, nullable=false)
     */
    private $libModele;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_modele", type="text", length=16777215, nullable=false)
     */
    private $descModele;

    /**
     * @var string
     *
     * @ORM\Column(name="code_pdf_modele", type="string", length=32, nullable=false)
     */
    private $codePdfModele;

    public function getIdPdfModele(): ?int
    {
        return $this->idPdfModele;
    }

    public function isIdPdfType(): ?bool
    {
        return $this->idPdfType;
    }

    public function setIdPdfType(bool $idPdfType): self
    {
        $this->idPdfType = $idPdfType;

        return $this;
    }

    public function getLibModele(): ?string
    {
        return $this->libModele;
    }

    public function setLibModele(string $libModele): self
    {
        $this->libModele = $libModele;

        return $this;
    }

    public function getDescModele(): ?string
    {
        return $this->descModele;
    }

    public function setDescModele(string $descModele): self
    {
        $this->descModele = $descModele;

        return $this;
    }

    public function getCodePdfModele(): ?string
    {
        return $this->codePdfModele;
    }

    public function setCodePdfModele(string $codePdfModele): self
    {
        $this->codePdfModele = $codePdfModele;

        return $this;
    }


}
