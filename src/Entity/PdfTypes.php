<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PdfTypes
 *
 * @ORM\Table(name="pdf_types")
 * @ORM\Entity
 */
class PdfTypes
{
    /**
     * @var bool
     *
     * @ORM\Column(name="id_pdf_type", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPdfType;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_pdf_type", type="string", length=64, nullable=false)
     */
    private $libPdfType;

    public function isIdPdfType(): ?bool
    {
        return $this->idPdfType;
    }

    public function getLibPdfType(): ?string
    {
        return $this->libPdfType;
    }

    public function setLibPdfType(string $libPdfType): self
    {
        $this->libPdfType = $libPdfType;

        return $this;
    }


}
