<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticlesValorisations
 *
 * @ORM\Table(name="articles_valorisations")
 * @ORM\Entity
 */
class ArticlesValorisations
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_valo", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idValo;

    /**
     * @var string
     *
     * @ORM\Column(name="groupe", type="string", length=255, nullable=false)
     */
    private $groupe;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_valo", type="string", length=64, nullable=false)
     */
    private $libValo;

    /**
     * @var string
     *
     * @ORM\Column(name="abrev_valo", type="string", length=6, nullable=false)
     */
    private $abrevValo;

    /**
     * @var bool
     *
     * @ORM\Column(name="popup", type="boolean", nullable=false)
     */
    private $popup;

    public function getIdValo(): ?int
    {
        return $this->idValo;
    }

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(string $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getLibValo(): ?string
    {
        return $this->libValo;
    }

    public function setLibValo(string $libValo): self
    {
        $this->libValo = $libValo;

        return $this;
    }

    public function getAbrevValo(): ?string
    {
        return $this->abrevValo;
    }

    public function setAbrevValo(string $abrevValo): self
    {
        $this->abrevValo = $abrevValo;

        return $this;
    }

    public function isPopup(): ?bool
    {
        return $this->popup;
    }

    public function setPopup(bool $popup): self
    {
        $this->popup = $popup;

        return $this;
    }


}
