<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentsEtats
 *
 * @ORM\Table(name="documents_etats", indexes={@ORM\Index(name="ordre", columns={"ordre"}), @ORM\Index(name="id_type_doc", columns={"id_type_doc"})})
 * @ORM\Entity
 */
class DocumentsEtats
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_etat_doc", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEtatDoc;

    /**
     * @var int
     *
     * @ORM\Column(name="id_type_doc", type="smallint", nullable=false)
     */
    private $idTypeDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_etat_doc", type="string", length=32, nullable=false)
     */
    private $libEtatDoc;

    /**
     * @var bool
     *
     * @ORM\Column(name="ordre", type="boolean", nullable=false)
     */
    private $ordre;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_open", type="boolean", nullable=false)
     */
    private $isOpen;

    public function getIdEtatDoc(): ?int
    {
        return $this->idEtatDoc;
    }

    public function getIdTypeDoc(): ?int
    {
        return $this->idTypeDoc;
    }

    public function setIdTypeDoc(int $idTypeDoc): self
    {
        $this->idTypeDoc = $idTypeDoc;

        return $this;
    }

    public function getLibEtatDoc(): ?string
    {
        return $this->libEtatDoc;
    }

    public function setLibEtatDoc(string $libEtatDoc): self
    {
        $this->libEtatDoc = $libEtatDoc;

        return $this;
    }

    public function isOrdre(): ?bool
    {
        return $this->ordre;
    }

    public function setOrdre(bool $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function isIsOpen(): ?bool
    {
        return $this->isOpen;
    }

    public function setIsOpen(bool $isOpen): self
    {
        $this->isOpen = $isOpen;

        return $this;
    }


}
