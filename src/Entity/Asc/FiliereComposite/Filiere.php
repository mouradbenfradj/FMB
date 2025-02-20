<?php

namespace App\Entity\Asc\FiliereComposite;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiProperty;

use App\Entity\Asc\Parc;
use App\Repository\Asc\FiliereComposite\FiliereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Filiere 
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "get_by_parc"={
 *             "method"="GET",
 *             "path"="/filieres/parc/{parcId}",
 *             "openapi_context"={
 *                 "summary"="Liste des filières pour un parc donné",
 *                 "parameters"={
 *                     {
 *                         "name"="parcId",
 *                         "in"="path",
 *                         "required"=true,
 *                         "type"="integer",
 *                         "description"="ID du parc"
 *                     }
 *                 }
 *             }
 *         },
 *         "count_by_parc"={
 *             "method"="GET",
 *             "path"="/filieres/parc/{parcId}/count",
 *             "openapi_context"={
 *                 "summary"="Compter le nombre de filières pour un parc donné",
 *                 "parameters"={
 *                     {
 *                         "name"="parcId",
 *                         "in"="path",
 *                         "required"=true,
 *                         "type"="integer",
 *                         "description"="ID du parc"
 *                     }
 *                 }
 *             },
 *             "controller"=FiliereRepository::class,
 *             "defaults"={"method"="countByParc"}
 *         }
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"parc": "exact"})
 * @ORM\Entity(repositoryClass=FiliereRepository::class)
 */
class Filiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomFiliere;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $observation = [];

    /**
     * @ORM\ManyToOne(targetEntity=Parc::class, inversedBy="filieres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parc;

    /**
     * @ORM\Column(type="boolean")
     */
    private $aireDeTravaille;

    /**
     * @ORM\OneToMany(targetEntity=Segment::class, mappedBy="filiere",fetch="EAGER",cascade={"persist"})
     */
    private $segments;

    public function __construct()
    {
        $this->segments = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->parc . ' : ' . $this->nomFiliere;
    }
    public function initFiliere(Parc $parc, string $nomFiliere, string $aireDeTravaille, ?array $observation = null)
    {
        $this->parc = $parc;
        $this->nomFiliere = $nomFiliere;
        $this->aireDeTravaille = $aireDeTravaille;
        $this->observation = $observation;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFiliere(): ?string
    {
        return $this->nomFiliere;
    }

    public function setNomFiliere(string $nomFiliere): self
    {
        $this->nomFiliere = $nomFiliere;

        return $this;
    }

    public function getObservation(): ?array
    {
        return $this->observation;
    }

    public function setObservation(?array $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function isAireDeTravaille(): ?bool
    {
        return $this->aireDeTravaille;
    }

    public function setAireDeTravaille(bool $aireDeTravaille): self
    {
        $this->aireDeTravaille = $aireDeTravaille;

        return $this;
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

    /**
     * @return Collection<int, Segment>
     */
    public function getSegments(): Collection
    {
        return $this->segments;
    }



    public function getFlottabiliter(): float
    {
        $somme = 0;
        foreach ($this->segments as $segment) {
            $somme += $segment->getFlottabiliter();
        }
        if (!$somme) {
            return 1;
        }
        return $somme;
    }

    public function getVolumesTotale(): float
    {
        $somme = 0;
        foreach ($this->segments as $segment) {
            $somme += $segment->getVolumesTotale();
        }
        if (!$somme) {
            return 1;
        }
        return $somme;
    }

    public function getTotaleCordes(): int
    {
        $somme = 0;
        foreach ($this->getSegments() as $segment) {
            $somme += $segment->getTotaleCordes();
        }
        return $somme;
    }
    public function getPoidCordes(): int
    {
        $somme = 0;
        foreach ($this->segments as $segment)
            $somme += $segment->getPoidCordes();
        return $somme;
    }



    public function getNombreEmplacements(): int
    {
        $somme = 0;
        foreach ($this->segments as $segment)
            $somme += $segment->getNombreEmplacements();
        return $somme;
    }
    public function getNombreEmplacementsVide(): int
    {
        $somme = 0;
        foreach ($this->segments as $segment) {
            $somme += $segment->getNombreEmplacementsVide();
        }
        return $somme;
    }
    public function getNombreEmplacementsRemplit(): int
    {
        $somme = 0;
        foreach ($this->segments as $segment) {
            $somme += $segment->getTotaleCordes();
        }
        return $somme;
    }

    public function addSegment(Segment $segment): self
    {
        if (!$this->segments->contains($segment)) {
            $this->segments[] = $segment;
            $segment->setFiliere($this);
        }

        return $this;
    }

    public function removeSegment(Segment $segment): self
    {
        if ($this->segments->removeElement($segment)) {
            // set the owning side to null (unless already changed)
            if ($segment->getFiliere() === $this) {
                $segment->setFiliere(null);
            }
        }

        return $this;
    }
}
