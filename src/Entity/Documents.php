<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documents
 *
 * @ORM\Table(name="documents", indexes={@ORM\Index(name="id_etat_doc", columns={"id_etat_doc"}), @ORM\Index(name="ref_adr_contact", columns={"ref_adr_contact"}), @ORM\Index(name="code_affaire", columns={"code_affaire"}), @ORM\Index(name="id_type_doc", columns={"id_type_doc"}), @ORM\Index(name="ref_contact", columns={"ref_contact"}), @ORM\Index(name="id_pays_contact", columns={"id_pays_contact"})})
 * @ORM\Entity
 */
class Documents
{
    /**
     * @var string
     *
     * @ORM\Column(name="ref_doc", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $refDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="code_affaire", type="string", length=64, nullable=false)
     */
    private $codeAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_contact", type="string", length=128, nullable=false)
     */
    private $nomContact;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_contact", type="text", length=16777215, nullable=false)
     */
    private $adresseContact;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal_contact", type="string", length=9, nullable=false)
     */
    private $codePostalContact;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_contact", type="string", length=28, nullable=false)
     */
    private $villeContact;

    /**
     * @var string
     *
     * @ORM\Column(name="app_tarifs", type="string", length=255, nullable=false)
     */
    private $appTarifs;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_doc", type="datetime", nullable=false)
     */
    private $dateCreationDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="code_file", type="string", length=32, nullable=false)
     */
    private $codeFile;

    /**
     * @var \Annuaire
     *
     * @ORM\ManyToOne(targetEntity="Annuaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_contact", referencedColumnName="ref_contact")
     * })
     */
    private $refContact;

    /**
     * @var \Adresses
     *
     * @ORM\ManyToOne(targetEntity="Adresses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_adr_contact", referencedColumnName="ref_adresse")
     * })
     */
    private $refAdrContact;

    /**
     * @var \DocumentsEtats
     *
     * @ORM\ManyToOne(targetEntity="DocumentsEtats")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etat_doc", referencedColumnName="id_etat_doc")
     * })
     */
    private $idEtatDoc;

    /**
     * @var \Pays
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pays_contact", referencedColumnName="id_pays")
     * })
     */
    private $idPaysContact;

    /**
     * @var \DocumentsTypes
     *
     * @ORM\ManyToOne(targetEntity="DocumentsTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_doc", referencedColumnName="id_type_doc")
     * })
     */
    private $idTypeDoc;

    public function getRefDoc(): ?string
    {
        return $this->refDoc;
    }

    public function getCodeAffaire(): ?string
    {
        return $this->codeAffaire;
    }

    public function setCodeAffaire(string $codeAffaire): self
    {
        $this->codeAffaire = $codeAffaire;

        return $this;
    }

    public function getNomContact(): ?string
    {
        return $this->nomContact;
    }

    public function setNomContact(string $nomContact): self
    {
        $this->nomContact = $nomContact;

        return $this;
    }

    public function getAdresseContact(): ?string
    {
        return $this->adresseContact;
    }

    public function setAdresseContact(string $adresseContact): self
    {
        $this->adresseContact = $adresseContact;

        return $this;
    }

    public function getCodePostalContact(): ?string
    {
        return $this->codePostalContact;
    }

    public function setCodePostalContact(string $codePostalContact): self
    {
        $this->codePostalContact = $codePostalContact;

        return $this;
    }

    public function getVilleContact(): ?string
    {
        return $this->villeContact;
    }

    public function setVilleContact(string $villeContact): self
    {
        $this->villeContact = $villeContact;

        return $this;
    }

    public function getAppTarifs(): ?string
    {
        return $this->appTarifs;
    }

    public function setAppTarifs(string $appTarifs): self
    {
        $this->appTarifs = $appTarifs;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreationDoc(): ?\DateTimeInterface
    {
        return $this->dateCreationDoc;
    }

    public function setDateCreationDoc(\DateTimeInterface $dateCreationDoc): self
    {
        $this->dateCreationDoc = $dateCreationDoc;

        return $this;
    }

    public function getCodeFile(): ?string
    {
        return $this->codeFile;
    }

    public function setCodeFile(string $codeFile): self
    {
        $this->codeFile = $codeFile;

        return $this;
    }

    public function getRefContact(): ?Annuaire
    {
        return $this->refContact;
    }

    public function setRefContact(?Annuaire $refContact): self
    {
        $this->refContact = $refContact;

        return $this;
    }

    public function getRefAdrContact(): ?Adresses
    {
        return $this->refAdrContact;
    }

    public function setRefAdrContact(?Adresses $refAdrContact): self
    {
        $this->refAdrContact = $refAdrContact;

        return $this;
    }

    public function getIdEtatDoc(): ?DocumentsEtats
    {
        return $this->idEtatDoc;
    }

    public function setIdEtatDoc(?DocumentsEtats $idEtatDoc): self
    {
        $this->idEtatDoc = $idEtatDoc;

        return $this;
    }

    public function getIdPaysContact(): ?Pays
    {
        return $this->idPaysContact;
    }

    public function setIdPaysContact(?Pays $idPaysContact): self
    {
        $this->idPaysContact = $idPaysContact;

        return $this;
    }

    public function getIdTypeDoc(): ?DocumentsTypes
    {
        return $this->idTypeDoc;
    }

    public function setIdTypeDoc(?DocumentsTypes $idTypeDoc): self
    {
        $this->idTypeDoc = $idTypeDoc;

        return $this;
    }


}
