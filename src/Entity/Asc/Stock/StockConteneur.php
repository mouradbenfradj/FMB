<?php

namespace App\Entity\Asc\Stock;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class StockConteneur
{

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiter;
    /**
     * @ORM\Column(type="float")
     */
    private $poid;
    /**
     * @ORM\Column(type="float")
     */
    private $longeur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pret = false;


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

    public function getPoid(): ?float
    {
        return $this->poid;
    }

    public function setPoid(float $poid): self
    {
        $this->poid = $poid;

        return $this;
    }
    public function getLongeur(): ?float
    {
        return $this->longeur;
    }

    public function setLongeur(float $longeur): self
    {
        $this->longeur = $longeur;

        return $this;
    }
}
