<?php

namespace App\Entity\Asc\Stock;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Asc\Conteneur\Corde;
use App\Repository\Asc\Stock\StockCordeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StockCordeRepository::class)
 */
class StockCorde
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
    private $quantiter;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pret;

    /**
     * @ORM\Column(type="date")
     */
    private $datedecreation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datederetirement;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datederetraittransfert;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datedemaetransfert;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeMiseAEaudate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $chaussement;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateassemblage;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datechaussement;

    /**
     * @ORM\ManyToOne(targetEntity=Corde::class, inversedBy="stockCordes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $corde;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiter(): ?int
    {
        return $this->quantiter;
    }

    public function setQuantiter(int $quantiter): self
    {
        $this->quantiter = $quantiter;

        return $this;
    }

    public function isPret(): ?bool
    {
        return $this->pret;
    }

    public function setPret(bool $pret): self
    {
        $this->pret = $pret;

        return $this;
    }

    public function getDatedecreation(): ?\DateTimeInterface
    {
        return $this->datedecreation;
    }

    public function setDatedecreation(\DateTimeInterface $datedecreation): self
    {
        $this->datedecreation = $datedecreation;

        return $this;
    }

    public function getDatederetirement(): ?\DateTimeInterface
    {
        return $this->datederetirement;
    }

    public function setDatederetirement(?\DateTimeInterface $datederetirement): self
    {
        $this->datederetirement = $datederetirement;

        return $this;
    }

    public function getDatederetraittransfert(): ?\DateTimeInterface
    {
        return $this->datederetraittransfert;
    }

    public function setDatederetraittransfert(?\DateTimeInterface $datederetraittransfert): self
    {
        $this->datederetraittransfert = $datederetraittransfert;

        return $this;
    }

    public function getDatedemaetransfert(): ?\DateTimeInterface
    {
        return $this->datedemaetransfert;
    }

    public function setDatedemaetransfert(?\DateTimeInterface $datedemaetransfert): self
    {
        $this->datedemaetransfert = $datedemaetransfert;

        return $this;
    }

    public function getDateDeMiseAEaudate(): ?\DateTimeInterface
    {
        return $this->dateDeMiseAEaudate;
    }

    public function setDateDeMiseAEaudate(?\DateTimeInterface $dateDeMiseAEaudate): self
    {
        $this->dateDeMiseAEaudate = $dateDeMiseAEaudate;

        return $this;
    }

    public function isChaussement(): ?bool
    {
        return $this->chaussement;
    }

    public function setChaussement(bool $chaussement): self
    {
        $this->chaussement = $chaussement;

        return $this;
    }

    public function getDateassemblage(): ?\DateTimeInterface
    {
        return $this->dateassemblage;
    }

    public function setDateassemblage(?\DateTimeInterface $dateassemblage): self
    {
        $this->dateassemblage = $dateassemblage;

        return $this;
    }

    public function getDatechaussement(): ?\DateTimeInterface
    {
        return $this->datechaussement;
    }

    public function setDatechaussement(?\DateTimeInterface $datechaussement): self
    {
        $this->datechaussement = $datechaussement;

        return $this;
    }

    public function getCorde(): ?Corde
    {
        return $this->corde;
    }

    public function setCorde(?Corde $corde): self
    {
        $this->corde = $corde;

        return $this;
    }
}
