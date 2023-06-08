<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phases
 *
 * @ORM\Table(name="phases")
 * @ORM\Entity
 */
class Phases
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPhase", type="string", length=255, nullable=false)
     */
    private $nomphase;

    /**
     * @var int
     *
     * @ORM\Column(name="ordeDaffichage", type="integer", nullable=false)
     */
    private $ordedaffichage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomphase(): ?string
    {
        return $this->nomphase;
    }

    public function setNomphase(string $nomphase): self
    {
        $this->nomphase = $nomphase;

        return $this;
    }

    public function getOrdedaffichage(): ?int
    {
        return $this->ordedaffichage;
    }

    public function setOrdedaffichage(int $ordedaffichage): self
    {
        $this->ordedaffichage = $ordedaffichage;

        return $this;
    }


}
