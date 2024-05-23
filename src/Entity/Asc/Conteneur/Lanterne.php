<?php

namespace App\Entity\Asc\Conteneur;

 
use App\Entity\Asc\Parc;
use App\Repository\Asc\Conteneur\LanterneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
  
 * @ORM\Entity(repositoryClass=LanterneRepository::class)
 */
class Lanterne  extends Conteneur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Parc::class, inversedBy="lanternes")
     */
    private $parc;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nbrPoche;

    public function initLanterne(Parc $parc, string $nomLanterne, string $quantiter, string $nbrpoche)
    {
        $this->parc = $parc;
        $this->init($nomLanterne, $quantiter);
        $this->nbrPoche = $nbrpoche;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParc(): ?Parc
    {
        return $this->parc;
    }

    public function setParc(?Parc $parc): self
    {
        $this->parc = $parc;

        return $this;
    }

    public function getNbrPoche(): ?int
    {
        return $this->nbrPoche;
    }

    public function setNbrPoche(int $nbrPoche): self
    {
        $this->nbrPoche = $nbrPoche;

        return $this;
    }
}
