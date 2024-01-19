<?php

namespace App\Entity\Asc\Alerte;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class Alerte
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomAlerte;

    /**
     * @ORM\Column(type="integer")
     */
    private $avantNombreJour;

    /**
     * @ORM\Column(type="integer")
     */
    private $avantNombreMoi;

    /**
     * @ORM\Column(type="integer")
     */
    private $avantNombreAnnee;




    public function getNomAlerte(): ?string
    {
        return $this->nomAlerte;
    }

    public function setNomAlerte(string $nomAlerte): self
    {
        $this->nomAlerte = $nomAlerte;

        return $this;
    }

    public function getAvantNombreJour(): ?int
    {
        return $this->avantNombreJour;
    }

    public function setAvantNombreJour(int $avantNombreJour): self
    {
        $this->avantNombreJour = $avantNombreJour;

        return $this;
    }

    public function getAvantNombreMoi(): ?int
    {
        return $this->avantNombreMoi;
    }

    public function setAvantNombreMoi(int $avantNombreMoi): self
    {
        $this->avantNombreMoi = $avantNombreMoi;

        return $this;
    }

    public function getAvantNombreAnnee(): ?int
    {
        return $this->avantNombreAnnee;
    }

    public function setAvantNombreAnnee(int $avantNombreAnnee): self
    {
        $this->avantNombreAnnee = $avantNombreAnnee;

        return $this;
    }
}
