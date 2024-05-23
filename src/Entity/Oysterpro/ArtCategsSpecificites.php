<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtCategsSpecificites
 *
 * @ORM\Table(name="art_categs_specificites")
 * @ORM\Entity
 */
class ArtCategsSpecificites
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_modele_spe", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idModeleSpe;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_modele_spe", type="string", length=255, nullable=false)
     */
    private $libModeleSpe;

    public function getIdModeleSpe(): ?int
    {
        return $this->idModeleSpe;
    }

    public function getLibModeleSpe(): ?string
    {
        return $this->libModeleSpe;
    }

    public function setLibModeleSpe(string $libModeleSpe): self
    {
        $this->libModeleSpe = $libModeleSpe;

        return $this;
    }


}
