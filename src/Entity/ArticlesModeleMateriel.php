<?php

namespace App\Entity;

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
     * @var int
     *
     * @ORM\Column(name="duree_garantie", type="smallint", nullable=false)
     */
    private $dureeGarantie;

    /**
     * @var \Articles
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_article", referencedColumnName="ref_article")
     * })
     */
    private $refArticle;

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getColisage(): ?string
    {
        return $this->colisage;
    }

    public function setColisage(string $colisage): self
    {
        $this->colisage = $colisage;

        return $this;
    }

    public function getDureeGarantie(): ?int
    {
        return $this->dureeGarantie;
    }

    public function setDureeGarantie(int $dureeGarantie): self
    {
        $this->dureeGarantie = $dureeGarantie;

        return $this;
    }

    public function getRefArticle(): ?Articles
    {
        return $this->refArticle;
    }

    public function setRefArticle(?Articles $refArticle): self
    {
        $this->refArticle = $refArticle;

        return $this;
    }


}
