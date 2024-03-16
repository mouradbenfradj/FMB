<?php

namespace App\Entity\Asc;

 
use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Conteneur\Lanterne;
use App\Entity\Asc\FiliereComposite\Filiere;
use App\Entity\Asc\Stock\Stock;
use App\Repository\Asc\ParcRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
  
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

    /**
     * @ORM\OneToMany(targetEntity=Filiere::class, mappedBy="parc")
     */
    private $filieres;
    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="parc", cascade={"persist", "remove"})
     */
    private $stocks;

    /**
     * @ORM\OneToMany(targetEntity=Corde::class, mappedBy="parc")
     */
    private $cordes;

    /**
     * @ORM\OneToMany(targetEntity=Lanterne::class, mappedBy="parc")
     */
    private $lanternes;

    public function __construct()
    {
        $this->filieres = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->cordes = new ArrayCollection();
        $this->lanternes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->libParc;
    }
    public function initParc(string $abrevParc, string $libParc)
    {
        $this->abrevParc = $abrevParc;
        $this->libParc = $libParc;
    }
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

    /**
     * @return Collection<int, Filiere>
     */
    public function getFilieres(): Collection
    {
        return $this->filieres;
    }

    public function addFiliere(Filiere $filiere): self
    {
        if (!$this->filieres->contains($filiere)) {
            $this->filieres[] = $filiere;
            $filiere->setParc($this);
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): self
    {
        if ($this->filieres->removeElement($filiere)) {
            // set the owning side to null (unless already changed)
            if ($filiere->getParc() === $this) {
                $filiere->setParc(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setParc($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getParc() === $this) {
                $stock->setParc(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Corde>
     */
    public function getCordes(): Collection
    {
        return $this->cordes;
    }

    public function addCorde(Corde $corde): self
    {
        if (!$this->cordes->contains($corde)) {
            $this->cordes[] = $corde;
            $corde->setParc($this);
        }

        return $this;
    }

    public function removeCorde(Corde $corde): self
    {
        if ($this->cordes->removeElement($corde)) {
            // set the owning side to null (unless already changed)
            if ($corde->getParc() === $this) {
                $corde->setParc(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lanterne>
     */
    public function getLanternes(): Collection
    {
        return $this->lanternes;
    }

    public function addLanterne(Lanterne $lanterne): self
    {
        if (!$this->lanternes->contains($lanterne)) {
            $this->lanternes[] = $lanterne;
            $lanterne->setParc($this);
        }

        return $this;
    }

    public function removeLanterne(Lanterne $lanterne): self
    {
        if ($this->lanternes->removeElement($lanterne)) {
            // set the owning side to null (unless already changed)
            if ($lanterne->getParc() === $this) {
                $lanterne->setParc(null);
            }
        }

        return $this;
    }
}