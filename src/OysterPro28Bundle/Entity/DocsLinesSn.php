<?php

namespace OysterPro28Bundle\Entity;

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
     * @var float
     *
     * @ORM\Column(name="sn_qte", type="float", precision=10, scale=0, nullable=false)
     */
    private $snQte;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_serie", type="string", length=32)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $numeroSerie;

    /**
     * @var \OysterPro28Bundle\Entity\DocsLines
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="OysterPro28Bundle\Entity\DocsLines")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_doc_line", referencedColumnName="ref_doc_line")
     * })
     */
    private $refDocLine;



    /**
     * Set snQte
     *
     * @param float $snQte
     * @return DocsLinesSn
     */
    public function setSnQte($snQte)
    {
        $this->snQte = $snQte;

        return $this;
    }

    /**
     * Get snQte
     *
     * @return float 
     */
    public function getSnQte()
    {
        return $this->snQte;
    }

    /**
     * Set numeroSerie
     *
     * @param string $numeroSerie
     * @return DocsLinesSn
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
     * Set refDocLine
     *
     * @param \OysterPro28Bundle\Entity\DocsLines $refDocLine
     * @return DocsLinesSn
     */
    public function setRefDocLine(\OysterPro28Bundle\Entity\DocsLines $refDocLine)
    {
        $this->refDocLine = $refDocLine;

        return $this;
    }

    /**
     * Get refDocLine
     *
     * @return \OysterPro28Bundle\Entity\DocsLines
     */
    public function getRefDocLine()
    {
        return $this->refDocLine;
    }
}
