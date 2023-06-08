<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtCategs
 *
 * @ORM\Table(name="art_categs", indexes={@ORM\Index(name="ref_art_categ_parent", columns={"ref_art_categ_parent"}), @ORM\Index(name="defaut_id_tva", columns={"defaut_id_tva"}), @ORM\Index(name="lib_art_categ", columns={"lib_art_categ"}), @ORM\Index(name="id_article_modele", columns={"modele"}), @ORM\Index(name="id_modele_spe", columns={"id_modele_spe"})})
 * @ORM\Entity
 */
class ArtCategs
{
    /**
     * @var string
     *
     * @ORM\Column(name="ref_art_categ", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $refArtCateg;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_art_categ", type="string", length=64, nullable=false)
     */
    private $libArtCateg;

    /**
     * @var string|null
     *
     * @ORM\Column(name="modele", type="string", length=255, nullable=true)
     */
    private $modele;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_modele_spe", type="smallint", nullable=true)
     */
    private $idModeleSpe;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_art_categ", type="text", length=16777215, nullable=false)
     */
    private $descArtCateg;

    /**
     * @var int|null
     *
     * @ORM\Column(name="defaut_id_tva", type="smallint", nullable=true)
     */
    private $defautIdTva;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_dispo", type="bigint", nullable=false)
     */
    private $dureeDispo;

    /**
     * @var string
     *
     * @ORM\Column(name="defaut_numero_compte_vente", type="string", length=10, nullable=false)
     */
    private $defautNumeroCompteVente;

    /**
     * @var string
     *
     * @ORM\Column(name="defaut_numero_compte_achat", type="string", length=10, nullable=false)
     */
    private $defautNumeroCompteAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="restriction", type="string", length=255, nullable=false)
     */
    private $restriction;

    /**
     * @var \ArtCategs
     *
     * @ORM\ManyToOne(targetEntity="ArtCategs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_art_categ_parent", referencedColumnName="ref_art_categ")
     * })
     */
    private $refArtCategParent;

    public function getRefArtCateg(): ?string
    {
        return $this->refArtCateg;
    }

    public function getLibArtCateg(): ?string
    {
        return $this->libArtCateg;
    }

    public function setLibArtCateg(string $libArtCateg): self
    {
        $this->libArtCateg = $libArtCateg;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(?string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getIdModeleSpe(): ?int
    {
        return $this->idModeleSpe;
    }

    public function setIdModeleSpe(?int $idModeleSpe): self
    {
        $this->idModeleSpe = $idModeleSpe;

        return $this;
    }

    public function getDescArtCateg(): ?string
    {
        return $this->descArtCateg;
    }

    public function setDescArtCateg(string $descArtCateg): self
    {
        $this->descArtCateg = $descArtCateg;

        return $this;
    }

    public function getDefautIdTva(): ?int
    {
        return $this->defautIdTva;
    }

    public function setDefautIdTva(?int $defautIdTva): self
    {
        $this->defautIdTva = $defautIdTva;

        return $this;
    }

    public function getDureeDispo(): ?string
    {
        return $this->dureeDispo;
    }

    public function setDureeDispo(string $dureeDispo): self
    {
        $this->dureeDispo = $dureeDispo;

        return $this;
    }

    public function getDefautNumeroCompteVente(): ?string
    {
        return $this->defautNumeroCompteVente;
    }

    public function setDefautNumeroCompteVente(string $defautNumeroCompteVente): self
    {
        $this->defautNumeroCompteVente = $defautNumeroCompteVente;

        return $this;
    }

    public function getDefautNumeroCompteAchat(): ?string
    {
        return $this->defautNumeroCompteAchat;
    }

    public function setDefautNumeroCompteAchat(string $defautNumeroCompteAchat): self
    {
        $this->defautNumeroCompteAchat = $defautNumeroCompteAchat;

        return $this;
    }

    public function getRestriction(): ?string
    {
        return $this->restriction;
    }

    public function setRestriction(string $restriction): self
    {
        $this->restriction = $restriction;

        return $this;
    }

    public function getRefArtCategParent(): ?self
    {
        return $this->refArtCategParent;
    }

    public function setRefArtCategParent(?self $refArtCategParent): self
    {
        $this->refArtCategParent = $refArtCategParent;

        return $this;
    }


}
