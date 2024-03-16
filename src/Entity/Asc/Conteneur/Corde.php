<?php

namespace App\Entity\Asc\Conteneur;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\StockCorde;
use App\Repository\Asc\Conteneur\CordeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CordeRepository::class)
 */
class Corde extends Conteneur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Parc::class, inversedBy="cordes")
     */
    private $parc;


    /**
     * @ORM\OneToMany(targetEntity=StockCorde::class, mappedBy="corde", orphanRemoval=true)
     */
    private $stockCordes;

    public function __construct()
    {
        $this->stockCordes = new ArrayCollection();
    }


    public function __toString(): string
    {
        return $this->getNom();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function initCorde(Parc $parc, string $nomCorde, int $quantiter)
    {
        $this->parc = $parc;
        $this->init($nomCorde, $quantiter);
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
     * @return Collection<int, StockCorde>
     */
    public function getStockCordes(): Collection
    {
        return $this->stockCordes;
    }

    public function addStockCorde(StockCorde $stockCorde): self
    {
        if (!$this->stockCordes->contains($stockCorde)) {
            $this->stockCordes[] = $stockCorde;
            $stockCorde->setCorde($this);
        }

        return $this;
    }

    public function removeStockCorde(StockCorde $stockCorde): self
    {
        if ($this->stockCordes->removeElement($stockCorde)) {
            // set the owning side to null (unless already changed)
            if ($stockCorde->getCorde() === $this) {
                $stockCorde->setCorde(null);
            }
        }

        return $this;
    }
}
