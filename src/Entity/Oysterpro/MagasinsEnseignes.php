<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * MagasinsEnseignes
 *
 * @ORM\Table(name="magasins_enseignes")
 * @ORM\Entity
 */
class MagasinsEnseignes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_mag_enseigne", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMagEnseigne;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_enseigne", type="string", length=255, nullable=false)
     */
    private $libEnseigne;

    public function getIdMagEnseigne(): ?int
    {
        return $this->idMagEnseigne;
    }

    public function getLibEnseigne(): ?string
    {
        return $this->libEnseigne;
    }

    public function setLibEnseigne(string $libEnseigne): self
    {
        $this->libEnseigne = $libEnseigne;

        return $this;
    }


}
