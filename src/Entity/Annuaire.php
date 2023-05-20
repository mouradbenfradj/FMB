<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annuaire
 *
 * @ORM\Table(name="annuaire", indexes={@ORM\Index(name="id_categorie", columns={"id_categorie"}), @ORM\Index(name="nom", columns={"nom"}), @ORM\Index(name="id_civilite", columns={"id_civilite"})})
 * @ORM\Entity
 */
class Annuaire
{
    /**
     * @var string
     *
     * @ORM\Column(name="ref_contact", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $refContact;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_civilite", type="smallint", nullable=true)
     */
    private $idCivilite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=128, nullable=false)
     */
    private $nom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_categorie", type="smallint", nullable=true)
     */
    private $idCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=32, nullable=false)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="tva_intra", type="string", length=32, nullable=false)
     */
    private $tvaIntra;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="blob", length=16777215, nullable=false)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=false)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime", nullable=false)
     */
    private $dateModification;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_archivage", type="datetime", nullable=true)
     */
    private $dateArchivage;

    public function getRefContact(): ?string
    {
        return $this->refContact;
    }

    public function getIdCivilite(): ?int
    {
        return $this->idCivilite;
    }

    public function setIdCivilite(?int $idCivilite): self
    {
        $this->idCivilite = $idCivilite;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?int $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getTvaIntra(): ?string
    {
        return $this->tvaIntra;
    }

    public function setTvaIntra(string $tvaIntra): self
    {
        $this->tvaIntra = $tvaIntra;

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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }

    public function setDateModification(\DateTimeInterface $dateModification): self
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    public function getDateArchivage(): ?\DateTimeInterface
    {
        return $this->dateArchivage;
    }

    public function setDateArchivage(?\DateTimeInterface $dateArchivage): self
    {
        $this->dateArchivage = $dateArchivage;

        return $this;
    }


}
