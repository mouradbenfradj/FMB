<?php

namespace App\Entity\Asc\FiliereComposite;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Conteneur\Lanterne;
use App\Entity\Asc\Conteneur\Poche;
use App\Entity\Asc\Stock\StockCorde;
use App\Repository\Asc\FiliereComposite\EmplacementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource      
 * @ORM\Entity(repositoryClass=EmplacementRepository::class)
 */
class Emplacement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $place;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRemplissage;

    /**
     * @ORM\ManyToOne(targetEntity=Segment::class, inversedBy="emplacements",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $segment;

    /**
     * @ORM\OneToMany(targetEntity=StockCorde::class, mappedBy="emplacement",fetch="EAGER")
     */
    private $stockCordes;


    public function __construct()
    {
        $this->stockCordes = new ArrayCollection();
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->place;
    }
    /**
     * Undocumented function
     *
     * @param integer $place
     * @return void
     */
    public function initEmplacement(Segment $segment, int $place)
    {
        $this->segment = $segment;
        $this->place = $place;
    }
    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getPlace(): ?int
    {
        return $this->place;
    }

    /**
     * Undocumented function
     *
     * @param integer $place
     * @return self
     */
    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param \DateTimeInterface $dateRemplissage
     * @return void
     */
    public function setDateRemplissage(\DateTimeInterface $dateRemplissage)
    {
        $this->dateRemplissage = $dateRemplissage;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getDateRemplissage()
    {
        return $this->dateRemplissage;
    }

    /**
     * Undocumented function
     *
     * @return Segment|null
     */
    public function getSegment(): ?Segment
    {
        return $this->segment;
    }

    /**
     * Undocumented function
     *
     * @param Segment|null $segment
     * @return self
     */
    public function setSegment(?Segment $segment): self
    {
        $this->segment = $segment;

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
            $stockCorde->setEmplacement($this);
        }

        return $this;
    }

    public function removeStockCorde(StockCorde $stockCorde): self
    {
        if ($this->stockCordes->removeElement($stockCorde)) {
            // set the owning side to null (unless already changed)
            if ($stockCorde->getEmplacement() === $this) {
                $stockCorde->setEmplacement(null);
            }
        }

        return $this;
    }
}
