<?php
/**
 * Created by PhpStorm.
 * User: moura
 * Date: 01/11/2017
 * Time: 11:56
 */

namespace OysterPro28Bundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * ArtCategs
 *
 * @ORM\Table(name="art_categs", indexes={@ORM\Index(name="lib_art_categ", columns={"lib_art_categ"}), @ORM\Index(name="ref_art_categ_parent", columns={"ref_art_categ_parent"}), @ORM\Index(name="id_article_modele", columns={"modele"}), @ORM\Index(name="defaut_id_tva", columns={"defaut_id_tva"}), @ORM\Index(name="id_modele_spe", columns={"id_modele_spe"})})
 * @ORM\Entity
 */
class ArtCategs
{
    /**
     * @var string
     *
     * @ORM\Column(name="lib_art_categ", type="string", length=64, nullable=false)
     */
    private $libArtCateg;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", nullable=true)
     */
    private $modele;

    /**
     * @var integer
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
     * @var integer
     *
     * @ORM\Column(name="defaut_id_tva", type="smallint", nullable=true)
     */
    private $defautIdTva;

    /**
     * @var integer
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
     * @ORM\Column(name="ref_art_categ_parent", type="string", length=32, nullable=true)
     */
    private $refArtCategParent;

    /**
     * @var string
     *
     * @ORM\Column(name="restriction", type="string", nullable=false)
     */
    private $restriction;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_art_categ", type="string", length=32)
     * @ORM\Id
     */
    private $refArtCateg;


    /**
     * Set libArtCateg
     *
     * @param string $libArtCateg
     *
     * @return ArtCategs
     */
    public function setLibArtCateg($libArtCateg)
    {
        $this->libArtCateg = $libArtCateg;

        return $this;
    }

    /**
     * Get libArtCateg
     *
     * @return string
     */
    public function getLibArtCateg()
    {
        return $this->libArtCateg;
    }

    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return ArtCategs
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set idModeleSpe
     *
     * @param integer $idModeleSpe
     *
     * @return ArtCategs
     */
    public function setIdModeleSpe($idModeleSpe)
    {
        $this->idModeleSpe = $idModeleSpe;

        return $this;
    }

    /**
     * Get idModeleSpe
     *
     * @return integer
     */
    public function getIdModeleSpe()
    {
        return $this->idModeleSpe;
    }

    /**
     * Set descArtCateg
     *
     * @param string $descArtCateg
     *
     * @return ArtCategs
     */
    public function setDescArtCateg($descArtCateg)
    {
        $this->descArtCateg = $descArtCateg;

        return $this;
    }

    /**
     * Get descArtCateg
     *
     * @return string
     */
    public function getDescArtCateg()
    {
        return $this->descArtCateg;
    }

    /**
     * Set defautIdTva
     *
     * @param integer $defautIdTva
     *
     * @return ArtCategs
     */
    public function setDefautIdTva($defautIdTva)
    {
        $this->defautIdTva = $defautIdTva;

        return $this;
    }

    /**
     * Get defautIdTva
     *
     * @return integer
     */
    public function getDefautIdTva()
    {
        return $this->defautIdTva;
    }

    /**
     * Set dureeDispo
     *
     * @param integer $dureeDispo
     *
     * @return ArtCategs
     */
    public function setDureeDispo($dureeDispo)
    {
        $this->dureeDispo = $dureeDispo;

        return $this;
    }

    /**
     * Get dureeDispo
     *
     * @return integer
     */
    public function getDureeDispo()
    {
        return $this->dureeDispo;
    }

    /**
     * Set defautNumeroCompteVente
     *
     * @param string $defautNumeroCompteVente
     *
     * @return ArtCategs
     */
    public function setDefautNumeroCompteVente($defautNumeroCompteVente)
    {
        $this->defautNumeroCompteVente = $defautNumeroCompteVente;

        return $this;
    }

    /**
     * Get defautNumeroCompteVente
     *
     * @return string
     */
    public function getDefautNumeroCompteVente()
    {
        return $this->defautNumeroCompteVente;
    }

    /**
     * Set defautNumeroCompteAchat
     *
     * @param string $defautNumeroCompteAchat
     *
     * @return ArtCategs
     */
    public function setDefautNumeroCompteAchat($defautNumeroCompteAchat)
    {
        $this->defautNumeroCompteAchat = $defautNumeroCompteAchat;

        return $this;
    }

    /**
     * Get defautNumeroCompteAchat
     *
     * @return string
     */
    public function getDefautNumeroCompteAchat()
    {
        return $this->defautNumeroCompteAchat;
    }

    /**
     * Set refArtCategParent
     *
     * @param string $refArtCategParent
     *
     * @return ArtCategs
     */
    public function setRefArtCategParent($refArtCategParent)
    {
        $this->refArtCategParent = $refArtCategParent;

        return $this;
    }

    /**
     * Get refArtCategParent
     *
     * @return string
     */
    public function getRefArtCategParent()
    {
        return $this->refArtCategParent;
    }

    /**
     * Set restriction
     *
     * @param string $restriction
     *
     * @return ArtCategs
     */
    public function setRestriction($restriction)
    {
        $this->restriction = $restriction;

        return $this;
    }

    /**
     * Get restriction
     *
     * @return string
     */
    public function getRestriction()
    {
        return $this->restriction;
    }

    /**
     * Get refArtCateg
     *
     * @return string
     */
    public function getRefArtCateg()
    {
        return $this->refArtCateg;
    }

    public function setRefArtCateg($ref)
    {
         $this->refArtCateg = $ref;
    }
}
