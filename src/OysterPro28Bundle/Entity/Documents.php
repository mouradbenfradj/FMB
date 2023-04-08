<?php

namespace OysterPro28Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documents
 *
 * @ORM\Table(name="documents", indexes={@ORM\Index(name="id_type_doc", columns={"id_type_doc"}), @ORM\Index(name="id_etat_doc", columns={"id_etat_doc"}), @ORM\Index(name="ref_contact", columns={"ref_contact"}), @ORM\Index(name="ref_adr_contact", columns={"ref_adr_contact"}), @ORM\Index(name="id_pays_contact", columns={"id_pays_contact"}), @ORM\Index(name="code_affaire", columns={"code_affaire"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Documents
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_affaire", type="string", length=64, nullable=false)
     */
    private $codeAffaire = "";

    /**
     * @var string
     *
     * @ORM\Column(name="nom_contact", type="string", length=128, nullable=false)
     */
    private $nomContact = "";

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_contact", type="text", length=16777215, nullable=false)
     */
    private $adresseContact = "";

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal_contact", type="string", length=9, nullable=false)
     */
    private $codePostalContact = "";

    /**
     * @var string
     *
     * @ORM\Column(name="ville_contact", type="string", length=28, nullable=false)
     */
    private $villeContact = "";

    /**
     * @var string
     *
     * @ORM\Column(name="app_tarifs", type="string", nullable=false)
     */
    private $appTarifs = "";

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=false)
     */
    private $description = "";

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
    private $codeFile = "";

    /**
     * @var string
     *
     * @ORM\Column(name="ref_doc", type="string", length=32)
     * @ORM\Id
     */
    private $refDoc;

    /**
     * @var \OysterPro28Bundle\Entity\Pays
     *
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pays_contact", referencedColumnName="id_pays")
     * })
     */
    private $idPaysContact;

    /**
     * @var \OysterPro28Bundle\Entity\Adresses
     *
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\Adresses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_adr_contact", referencedColumnName="ref_adresse")
     * })
     */
    private $refAdrContact;

    /**
     * @var \OysterPro28Bundle\Entity\Annuaire
     *
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\Annuaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_contact", referencedColumnName="ref_contact")
     * })
     */
    private $refContact;

    /**
     * @var \OysterPro28Bundle\Entity\DocumentsEtats
     *
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\DocumentsEtats")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etat_doc", referencedColumnName="id_etat_doc")
     * })
     */
    private $idEtatDoc;

    /**
     * @var \OysterPro28Bundle\Entity\DocumentsTypes
     *
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\DocumentsTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_doc", referencedColumnName="id_type_doc")
     * })
     */
    private $idTypeDoc;


    /**
     * @ORM\OneToMany(targetEntity="OysterPro28Bundle\Entity\DocsLines", mappedBy="refDoc" ,cascade={"persist","remove"})
     */
    private $docsLines;


    public function __toString()
    {
        return $this->refDoc;
    }

    /**
     * Set codeAffaire
     *
     * @param string $codeAffaire
     * @return Documents
     */
    public function setCodeAffaire($codeAffaire)
    {
        $this->codeAffaire = $codeAffaire;

        return $this;
    }

    /**
     * Get codeAffaire
     *
     * @return string
     */
    public function getCodeAffaire()
    {
        return $this->codeAffaire;
    }

    /**
     * Set nomContact
     *
     * @param string $nomContact
     * @return Documents
     */
    public function setNomContact($nomContact)
    {
        $this->nomContact = $nomContact;

        return $this;
    }

    /**
     * Get nomContact
     *
     * @return string
     */
    public function getNomContact()
    {
        return $this->nomContact;
    }

    /**
     * Set adresseContact
     *
     * @param string $adresseContact
     * @return Documents
     */
    public function setAdresseContact($adresseContact)
    {
        $this->adresseContact = $adresseContact;

        return $this;
    }

    /**
     * Get adresseContact
     *
     * @return string
     */
    public function getAdresseContact()
    {
        return $this->adresseContact;
    }

    /**
     * Set codePostalContact
     *
     * @param string $codePostalContact
     * @return Documents
     */
    public function setCodePostalContact($codePostalContact)
    {
        $this->codePostalContact = $codePostalContact;

        return $this;
    }

    /**
     * Get codePostalContact
     *
     * @return string
     */
    public function getCodePostalContact()
    {
        return $this->codePostalContact;
    }

    /**
     * Set villeContact
     *
     * @param string $villeContact
     * @return Documents
     */
    public function setVilleContact($villeContact)
    {
        $this->villeContact = $villeContact;

        return $this;
    }

    /**
     * Get villeContact
     *
     * @return string
     */
    public function getVilleContact()
    {
        return $this->villeContact;
    }

    /**
     * Set appTarifs
     *
     * @param string $appTarifs
     * @return Documents
     */
    public function setAppTarifs($appTarifs)
    {
        $this->appTarifs = $appTarifs;

        return $this;
    }

    /**
     * Get appTarifs
     *
     * @return string
     */
    public function getAppTarifs()
    {
        return $this->appTarifs;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Documents
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreationDoc
     *
     * @param \DateTime $dateCreationDoc
     * @return Documents
     */
    public function setDateCreationDoc($dateCreationDoc)
    {
        $this->dateCreationDoc = $dateCreationDoc;

        return $this;
    }

    /**
     * Get dateCreationDoc
     *
     * @return \DateTime
     */
    public function getDateCreationDoc()
    {
        return $this->dateCreationDoc;
    }

    /**
     * Set codeFile
     *
     * @param string $codeFile
     * @return Documents
     */
    public function setCodeFile($codeFile)
    {
        $this->codeFile = $codeFile;

        return $this;
    }

    /**
     * Get codeFile
     *
     * @return string
     */
    public function getCodeFile()
    {
        return $this->codeFile;
    }

    /**
     * Get refDoc
     *
     * @return string
     */
    public function getRefDoc()
    {
        return $this->refDoc;
    }

    /**
     * @ORM\PrePersist
     */
    public function generateRefDoc()
    {
        $this->refDoc = uniqid();
    }

    /**
     * Set idPaysContact
     *
     * @param \OysterPro28Bundle\Entity\Pays $idPaysContact
     * @return Documents
     */
    public function setIdPaysContact(\OysterPro28Bundle\Entity\Pays $idPaysContact = null)
    {
        $this->idPaysContact = $idPaysContact;

        return $this;
    }

    /**
     * Get idPaysContact
     *
     * @return \OysterPro28Bundle\Entity\Pays
     */
    public function getIdPaysContact()
    {
        return $this->idPaysContact;
    }

    /**
     * Set refAdrContact
     *
     * @param \OysterPro28Bundle\Entity\Adresses $refAdrContact
     * @return Documents
     */
    public function setRefAdrContact(\OysterPro28Bundle\Entity\Adresses $refAdrContact = null)
    {
        $this->refAdrContact = $refAdrContact;

        return $this;
    }

    /**
     * Get refAdrContact
     *
     * @return \OysterPro28Bundle\Entity\Adresses
     */
    public function getRefAdrContact()
    {
        return $this->refAdrContact;
    }

    /**
     * Set refContact
     *
     * @param \OysterPro28Bundle\Entity\Annuaire $refContact
     * @return Documents
     */
    public function setRefContact(\OysterPro28Bundle\Entity\Annuaire $refContact = null)
    {
        $this->refContact = $refContact;

        return $this;
    }

    /**
     * Get refContact
     *
     * @return \OysterPro28Bundle\Entity\Annuaire
     */
    public function getRefContact()
    {
        return $this->refContact;
    }

    /**
     * Set idEtatDoc
     *
     * @param \OysterPro28Bundle\Entity\DocumentsEtats $idEtatDoc
     * @return Documents
     */
    public function setIdEtatDoc(\OysterPro28Bundle\Entity\DocumentsEtats $idEtatDoc = null)
    {
        $this->idEtatDoc = $idEtatDoc;

        return $this;
    }

    /**
     * Get idEtatDoc
     *
     * @return \OysterPro28Bundle\Entity\DocumentsEtats
     */
    public function getIdEtatDoc()
    {
        return $this->idEtatDoc;
    }

    /**
     * Set idTypeDoc
     *
     * @param \OysterPro28Bundle\Entity\DocumentsTypes $idTypeDoc
     * @return Documents
     */
    public function setIdTypeDoc(\OysterPro28Bundle\Entity\DocumentsTypes $idTypeDoc = null)
    {
        $this->idTypeDoc = $idTypeDoc;

        return $this;
    }

    /**
     * Get idTypeDoc
     *
     * @return \OysterPro28Bundle\Entity\DocumentsTypes
     */
    public function getIdTypeDoc()
    {
        return $this->idTypeDoc;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->docsLines = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add docsLines
     *
     * @param \OysterPro28Bundle\Entity\DocsLines $docsLines
     * @return Documents
     */
    public function addDocsLine(\OysterPro28Bundle\Entity\DocsLines $docsLines)
    {
        $this->docsLines[] = $docsLines;

        return $this;
    }

    /**
     * Remove docsLines
     *
     * @param \OysterPro28Bundle\Entity\DocsLines $docsLines
     */
    public function removeDocsLine(\OysterPro28Bundle\Entity\DocsLines $docsLines)
    {
        $this->docsLines->removeElement($docsLines);
    }

    /**
     * Get docsLines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocsLines()
    {
        return $this->docsLines;
    }

    /**
     * Set refDoc
     *
     * @param string $refDoc
     * @return Documents
     */
    public function setRefDoc($refDoc)
    {
        $this->refDoc = $refDoc;

        return $this;
    }
}
