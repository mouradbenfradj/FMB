<?php

namespace App\Entity\Asc\Conteneur;


use App\Entity\Asc\Parc;
use App\Repository\Asc\Conteneur\PocheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PocheRepository::class)
 */
class Poche extends Conteneur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=parc::class, inversedBy="cordes",cascade={"persist"})
     */
    private $parc;


    public function initPoche(Parc $parc, string $nomPoche, int $nbrTotaleEnStock)
    {
        $this->parc = $parc;
        $this->init($nomPoche, $nbrTotaleEnStock);
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
}
