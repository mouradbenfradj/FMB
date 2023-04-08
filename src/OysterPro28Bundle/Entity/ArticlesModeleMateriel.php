<?php
/**
 * Created by PhpStorm.
 * User: moura
 * Date: 01/11/2017
 * Time: 11:50
 */

namespace OysterPro28Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticlesModeleMateriel
 *
 * @ORM\Table(name="articles_modele_materiel")
 * @ORM\Entity
 */
class ArticlesModeleMateriel
{
    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float", precision=10, scale=0, nullable=false)
     */
    private $poids;

    /**
     * @var string
     *
     * @ORM\Column(name="colisage", type="string", length=32, nullable=false)
     */
    private $colisage;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree_garantie", type="smallint", nullable=false)
     */
    private $dureeGarantie;

    /**
     * @var \OysterPro28Bundle\Entity\Articles
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="OysterPro28Bundle\Entity\Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_article", referencedColumnName="ref_article")
     * })
     */
    private $refArticle;



    /**
     * Set poids
     *
     * @param float $poids
     *
     * @return ArticlesModeleMateriel
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return float
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set colisage
     *
     * @param string $colisage
     *
     * @return ArticlesModeleMateriel
     */
    public function setColisage($colisage)
    {
        $this->colisage = $colisage;

        return $this;
    }

    /**
     * Get colisage
     *
     * @return string
     */
    public function getColisage()
    {
        return $this->colisage;
    }

    /**
     * Set dureeGarantie
     *
     * @param integer $dureeGarantie
     *
     * @return ArticlesModeleMateriel
     */
    public function setDureeGarantie($dureeGarantie)
    {
        $this->dureeGarantie = $dureeGarantie;

        return $this;
    }

    /**
     * Get dureeGarantie
     *
     * @return integer
     */
    public function getDureeGarantie()
    {
        return $this->dureeGarantie;
    }

    /**
     * Set refArticle
     *
     * @param \OysterPro28Bundle\Entity\Articles $refArticle
     *
     * @return ArticlesModeleMateriel
     */
    public function setRefArticle(\OysterPro28Bundle\Entity\Articles $refArticle)
    {
        $this->refArticle = $refArticle;

        return $this;
    }

    /**
     * Get refArticle
     *
     * @return \OysterPro28Bundle\Entity\Articles
     */
    public function getRefArticle()
    {
        return $this->refArticle;
    }
}
