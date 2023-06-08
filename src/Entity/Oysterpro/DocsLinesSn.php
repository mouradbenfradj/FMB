<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocsLinesSn
 *
 * @ORM\Table(name="docs_lines_sn", indexes={@ORM\Index(name="ref_doc_line", columns={"ref_doc_line"}), @ORM\Index(name="numero_serie", columns={"numero_serie"})})
 * @ORM\Entity
 */
class DocsLinesSn
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
     * @var \DocsLines
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="DocsLines")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_doc_line", referencedColumnName="ref_doc_line")
     * })
     */
    private $refDocLine;

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

    public function getRefDocLine(): ?DocsLines
    {
        return $this->refDocLine;
    }

    public function setRefDocLine(?DocsLines $refDocLine): self
    {
        $this->refDocLine = $refDocLine;

        return $this;
    }


}
