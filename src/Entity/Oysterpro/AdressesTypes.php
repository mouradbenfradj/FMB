<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdressesTypes
 *
 * @ORM\Table(name="adresses_types")
 * @ORM\Entity
 */
class AdressesTypes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_adresse_type", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAdresseType;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_type", type="string", length=64, nullable=false)
     */
    private $adresseType;

    /**
     * @var int
     *
     * @ORM\Column(name="defaut", type="smallint", nullable=false)
     */
    private $defaut;

    public function getIdAdresseType(): ?int
    {
        return $this->idAdresseType;
    }

    public function getAdresseType(): ?string
    {
        return $this->adresseType;
    }

    public function setAdresseType(string $adresseType): self
    {
        $this->adresseType = $adresseType;

        return $this;
    }

    public function getDefaut(): ?int
    {
        return $this->defaut;
    }

    public function setDefaut(int $defaut): self
    {
        $this->defaut = $defaut;

        return $this;
    }


}
