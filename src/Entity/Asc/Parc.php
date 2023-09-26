<?php

namespace App\Entity\Asc;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Asc\ParcRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ParcRepository::class)
 */
class Parc
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_magasin", type="smallint", nullable=false, unique=true)
     */
    private $idParc;
    /**
     * @var string
     *
     * @ORM\Column(name="lib_parc", type="string", length=64, nullable=false)
     */
    private $libParc;

    /**
     * @var string
     *
     * @ORM\Column(name="abrev_parc", type="string", length=32, nullable=false)
     */
    private $abrevParc;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibParc(): ?string
    {
        return $this->libParc;
    }

    public function setLibParc(string $libParc): self
    {
        $this->libParc = $libParc;

        return $this;
    }

    public function getAbrevParc(): ?string
    {
        return $this->abrevParc;
    }

    public function setAbrevParc(string $abrevParc): self
    {
        $this->abrevParc = $abrevParc;

        return $this;
    }

    public function getIdParc(): ?int
    {
        return $this->idParc;
    }

    public function setIdParc(int $idParc): self
    {
        $this->idParc = $idParc;

        return $this;
    }

}
