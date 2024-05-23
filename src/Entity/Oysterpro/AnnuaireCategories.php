<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnuaireCategories
 *
 * @ORM\Table(name="annuaire_categories")
 * @ORM\Entity
 */
class AnnuaireCategories
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categorie", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_categorie", type="string", length=32, nullable=false)
     */
    private $libCategorie;

    /**
     * @var bool
     *
     * @ORM\Column(name="ordre", type="boolean", nullable=false)
     */
    private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="app_tarifs", type="string", length=255, nullable=false)
     */
    private $appTarifs;

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function getLibCategorie(): ?string
    {
        return $this->libCategorie;
    }

    public function setLibCategorie(string $libCategorie): self
    {
        $this->libCategorie = $libCategorie;

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

    public function getAppTarifs(): ?string
    {
        return $this->appTarifs;
    }

    public function setAppTarifs(string $appTarifs): self
    {
        $this->appTarifs = $appTarifs;

        return $this;
    }


}
