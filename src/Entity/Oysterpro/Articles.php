<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 *
 * @ORM\Table(name="articles", uniqueConstraints={@ORM\UniqueConstraint(name="ref_interne", columns={"ref_interne"})}, indexes={@ORM\Index(name="ref_art_categ", columns={"ref_art_categ"}), @ORM\Index(name="dispo", columns={"dispo"}), @ORM\Index(name="id_tva", columns={"id_tva"}), @ORM\Index(name="id_modele_spe", columns={"id_modele_spe"}), @ORM\Index(name="lib_article", columns={"lib_article"}), @ORM\Index(name="ref_constructeur", columns={"ref_constructeur"}), @ORM\Index(name="ref_oem", columns={"ref_oem"}), @ORM\Index(name="id_valo", columns={"id_valo"})})
 * @ORM\Entity
 */
class Articles
{
    /**
     * @var string
     *
     * @ORM\Column(name="ref_article", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $refArticle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ref_oem", type="string", length=64, nullable=true)
     */
    private $refOem;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ref_interne", type="string", length=32, nullable=true)
     */
    private $refInterne;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_article", type="string", length=250, nullable=false)
     */
    private $libArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_ticket", type="string", length=64, nullable=false)
     */
    private $libTicket;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_courte", type="blob", length=16777215, nullable=false)
     */
    private $descCourte;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_longue", type="blob", length=16777215, nullable=false)
     */
    private $descLongue;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255, nullable=false)
     */
    private $modele;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ref_constructeur", type="string", length=32, nullable=true)
     */
    private $refConstructeur;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix_public_ht", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixPublicHt;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix_achat_ht", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixAchatHt;

    /**
     * @var float|null
     *
     * @ORM\Column(name="paa_ht", type="float", precision=10, scale=0, nullable=true)
     */
    private $paaHt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="paa_last_maj", type="datetime", nullable=false)
     */
    private $paaLastMaj;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_tva", type="smallint", nullable=true)
     */
    private $idTva;

    /**
     * @var int
     *
     * @ORM\Column(name="promo", type="smallint", nullable=false)
     */
    private $promo;

    /**
     * @var float
     *
     * @ORM\Column(name="valo_indice", type="float", precision=10, scale=0, nullable=false)
     */
    private $valoIndice;

    /**
     * @var bool
     *
     * @ORM\Column(name="lot", type="boolean", nullable=false)
     */
    private $lot;

    /**
     * @var bool
     *
     * @ORM\Column(name="composant", type="boolean", nullable=false)
     */
    private $composant;

    /**
     * @var bool
     *
     * @ORM\Column(name="variante", type="boolean", nullable=false)
     */
    private $variante;

    /**
     * @var bool
     *
     * @ORM\Column(name="gestion_sn", type="boolean", nullable=false)
     */
    private $gestionSn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_dispo", type="datetime", nullable=false)
     */
    private $dateDebutDispo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_dispo", type="datetime", nullable=false)
     */
    private $dateFinDispo;

    /**
     * @var bool
     *
     * @ORM\Column(name="dispo", type="boolean", nullable=false)
     */
    private $dispo;

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
     * @var string|null
     *
     * @ORM\Column(name="numero_compte_achat", type="string", length=10, nullable=true)
     */
    private $numeroCompteAchat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numero_compte_vente", type="string", length=10, nullable=true)
     */
    private $numeroCompteVente;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_achetable", type="boolean", nullable=false)
     */
    private $isAchetable;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_vendable", type="boolean", nullable=false)
     */
    private $isVendable;

    /**
     * @var \ArtCategsSpecificites
     *
     * @ORM\ManyToOne(targetEntity="ArtCategsSpecificites")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modele_spe", referencedColumnName="id_modele_spe")
     * })
     */
    private $idModeleSpe;

    /**
     * @var \ArticlesValorisations
     *
     * @ORM\ManyToOne(targetEntity="ArticlesValorisations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_valo", referencedColumnName="id_valo")
     * })
     */
    private $idValo;

    /**
     * @var \ArtCategs
     *
     * @ORM\ManyToOne(targetEntity="ArtCategs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_art_categ", referencedColumnName="ref_art_categ")
     * })
     */
    private $refArtCateg;

    public function getRefArticle(): ?string
    {
        return $this->refArticle;
    }

    public function getRefOem(): ?string
    {
        return $this->refOem;
    }

    public function setRefOem(?string $refOem): self
    {
        $this->refOem = $refOem;

        return $this;
    }

    public function getRefInterne(): ?string
    {
        return $this->refInterne;
    }

    public function setRefInterne(?string $refInterne): self
    {
        $this->refInterne = $refInterne;

        return $this;
    }

    public function getLibArticle(): ?string
    {
        return $this->libArticle;
    }

    public function setLibArticle(string $libArticle): self
    {
        $this->libArticle = $libArticle;

        return $this;
    }

    public function getLibTicket(): ?string
    {
        return $this->libTicket;
    }

    public function setLibTicket(string $libTicket): self
    {
        $this->libTicket = $libTicket;

        return $this;
    }

    public function getDescCourte()
    {
        return $this->descCourte;
    }

    public function setDescCourte($descCourte): self
    {
        $this->descCourte = $descCourte;

        return $this;
    }

    public function getDescLongue()
    {
        return $this->descLongue;
    }

    public function setDescLongue($descLongue): self
    {
        $this->descLongue = $descLongue;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getRefConstructeur(): ?string
    {
        return $this->refConstructeur;
    }

    public function setRefConstructeur(?string $refConstructeur): self
    {
        $this->refConstructeur = $refConstructeur;

        return $this;
    }

    public function getPrixPublicHt(): ?float
    {
        return $this->prixPublicHt;
    }

    public function setPrixPublicHt(?float $prixPublicHt): self
    {
        $this->prixPublicHt = $prixPublicHt;

        return $this;
    }

    public function getPrixAchatHt(): ?float
    {
        return $this->prixAchatHt;
    }

    public function setPrixAchatHt(?float $prixAchatHt): self
    {
        $this->prixAchatHt = $prixAchatHt;

        return $this;
    }

    public function getPaaHt(): ?float
    {
        return $this->paaHt;
    }

    public function setPaaHt(?float $paaHt): self
    {
        $this->paaHt = $paaHt;

        return $this;
    }

    public function getPaaLastMaj(): ?\DateTimeInterface
    {
        return $this->paaLastMaj;
    }

    public function setPaaLastMaj(\DateTimeInterface $paaLastMaj): self
    {
        $this->paaLastMaj = $paaLastMaj;

        return $this;
    }

    public function getIdTva(): ?int
    {
        return $this->idTva;
    }

    public function setIdTva(?int $idTva): self
    {
        $this->idTva = $idTva;

        return $this;
    }

    public function getPromo(): ?int
    {
        return $this->promo;
    }

    public function setPromo(int $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getValoIndice(): ?float
    {
        return $this->valoIndice;
    }

    public function setValoIndice(float $valoIndice): self
    {
        $this->valoIndice = $valoIndice;

        return $this;
    }

    public function isLot(): ?bool
    {
        return $this->lot;
    }

    public function setLot(bool $lot): self
    {
        $this->lot = $lot;

        return $this;
    }

    public function isComposant(): ?bool
    {
        return $this->composant;
    }

    public function setComposant(bool $composant): self
    {
        $this->composant = $composant;

        return $this;
    }

    public function isVariante(): ?bool
    {
        return $this->variante;
    }

    public function setVariante(bool $variante): self
    {
        $this->variante = $variante;

        return $this;
    }

    public function isGestionSn(): ?bool
    {
        return $this->gestionSn;
    }

    public function setGestionSn(bool $gestionSn): self
    {
        $this->gestionSn = $gestionSn;

        return $this;
    }

    public function getDateDebutDispo(): ?\DateTimeInterface
    {
        return $this->dateDebutDispo;
    }

    public function setDateDebutDispo(\DateTimeInterface $dateDebutDispo): self
    {
        $this->dateDebutDispo = $dateDebutDispo;

        return $this;
    }

    public function getDateFinDispo(): ?\DateTimeInterface
    {
        return $this->dateFinDispo;
    }

    public function setDateFinDispo(\DateTimeInterface $dateFinDispo): self
    {
        $this->dateFinDispo = $dateFinDispo;

        return $this;
    }

    public function isDispo(): ?bool
    {
        return $this->dispo;
    }

    public function setDispo(bool $dispo): self
    {
        $this->dispo = $dispo;

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

    public function getNumeroCompteAchat(): ?string
    {
        return $this->numeroCompteAchat;
    }

    public function setNumeroCompteAchat(?string $numeroCompteAchat): self
    {
        $this->numeroCompteAchat = $numeroCompteAchat;

        return $this;
    }

    public function getNumeroCompteVente(): ?string
    {
        return $this->numeroCompteVente;
    }

    public function setNumeroCompteVente(?string $numeroCompteVente): self
    {
        $this->numeroCompteVente = $numeroCompteVente;

        return $this;
    }

    public function isIsAchetable(): ?bool
    {
        return $this->isAchetable;
    }

    public function setIsAchetable(bool $isAchetable): self
    {
        $this->isAchetable = $isAchetable;

        return $this;
    }

    public function isIsVendable(): ?bool
    {
        return $this->isVendable;
    }

    public function setIsVendable(bool $isVendable): self
    {
        $this->isVendable = $isVendable;

        return $this;
    }

    public function getIdModeleSpe(): ?ArtCategsSpecificites
    {
        return $this->idModeleSpe;
    }

    public function setIdModeleSpe(?ArtCategsSpecificites $idModeleSpe): self
    {
        $this->idModeleSpe = $idModeleSpe;

        return $this;
    }

    public function getIdValo(): ?ArticlesValorisations
    {
        return $this->idValo;
    }

    public function setIdValo(?ArticlesValorisations $idValo): self
    {
        $this->idValo = $idValo;

        return $this;
    }

    public function getRefArtCateg(): ?ArtCategs
    {
        return $this->refArtCateg;
    }

    public function setRefArtCateg(?ArtCategs $refArtCateg): self
    {
        $this->refArtCateg = $refArtCateg;

        return $this;
    }


}
