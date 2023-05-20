<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresses
 *
 * @ORM\Table(name="adresses", indexes={@ORM\Index(name="ref_contact", columns={"ref_contact"}), @ORM\Index(name="id_pays", columns={"id_pays"}), @ORM\Index(name="id_type_adresse", columns={"id_type_adresse"})})
 * @ORM\Entity
 */
class Adresses
{
    /**
     * @var string
     *
     * @ORM\Column(name="ref_adresse", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $refAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_contact", type="string", length=32, nullable=false)
     */
    private $refContact;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_type_adresse", type="smallint", nullable=true)
     */
    private $idTypeAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_adresse", type="string", length=128, nullable=false)
     */
    private $libAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="text_adresse", type="string", length=160, nullable=false)
     */
    private $textAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=9, nullable=false)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=28, nullable=false)
     */
    private $ville;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_pays", type="smallint", nullable=true)
     */
    private $idPays;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="blob", length=16777215, nullable=false)
     */
    private $note;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="smallint", nullable=false)
     */
    private $ordre;

    public function getRefAdresse(): ?string
    {
        return $this->refAdresse;
    }

    public function getRefContact(): ?string
    {
        return $this->refContact;
    }

    public function setRefContact(string $refContact): self
    {
        $this->refContact = $refContact;

        return $this;
    }

    public function getIdTypeAdresse(): ?int
    {
        return $this->idTypeAdresse;
    }

    public function setIdTypeAdresse(?int $idTypeAdresse): self
    {
        $this->idTypeAdresse = $idTypeAdresse;

        return $this;
    }

    public function getLibAdresse(): ?string
    {
        return $this->libAdresse;
    }

    public function setLibAdresse(string $libAdresse): self
    {
        $this->libAdresse = $libAdresse;

        return $this;
    }

    public function getTextAdresse(): ?string
    {
        return $this->textAdresse;
    }

    public function setTextAdresse(string $textAdresse): self
    {
        $this->textAdresse = $textAdresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getIdPays(): ?int
    {
        return $this->idPays;
    }

    public function setIdPays(?int $idPays): self
    {
        $this->idPays = $idPays;

        return $this;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setNote($note): self
    {
        $this->note = $note;

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


}
