<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Repository\StockLanterneRepository;

#[ORM\Entity(repositoryClass: StockLanterneRepository::class)]
class StockLanterne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $datedecreation = null;

    #[ORM\ManyToOne(inversedBy: 'stockLanternes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lanterne $lanterne = null;

    #[ORM\ManyToOne(inversedBy: 'stockLanternes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StockArticleSn $stockArticleSn = null;

    #[ORM\ManyToOne(inversedBy: 'stockLanternes')]
    private ?Emplacement $emplacement = null;

    #[ORM\Column]
    private ?bool $pret = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $datederetirement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $datederetraittransfert = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $datedemaetransfert = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateDeMiseAEau = null;

    public function __toString(): string
    {
        return $this->lanterne->getNomLanterne();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedecreation(): ?\DateTime
    {
        return $this->datedecreation;
    }

    public function setDatedecreation(?\DateTime $datedecreation): static
    {
        $this->datedecreation = $datedecreation;

        return $this;
    }

    public function getLanterne(): ?Lanterne
    {
        return $this->lanterne;
    }

    public function setLanterne(?Lanterne $lanterne): static
    {
        $this->lanterne = $lanterne;

        return $this;
    }

    public function getStockArticleSn(): ?StockArticleSn
    {
        return $this->stockArticleSn;
    }

    public function setStockArticleSn(?StockArticleSn $stockArticleSn): static
    {
        $this->stockArticleSn = $stockArticleSn;

        return $this;
    }

    public function getEmplacement(): ?Emplacement
    {
        return $this->emplacement;
    }

    public function setEmplacement(?Emplacement $emplacement): static
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function isPret(): ?bool
    {
        return $this->pret;
    }

    public function setPret(bool $pret): static
    {
        $this->pret = $pret;

        return $this;
    }

    public function getDatederetirement(): ?\DateTime
    {
        return $this->datederetirement;
    }

    public function setDatederetirement(?\DateTime $datederetirement): static
    {
        $this->datederetirement = $datederetirement;

        return $this;
    }

    public function getDatederetraittransfert(): ?\DateTime
    {
        return $this->datederetraittransfert;
    }

    public function setDatederetraittransfert(?\DateTime $datederetraittransfert): static
    {
        $this->datederetraittransfert = $datederetraittransfert;

        return $this;
    }

    public function getDatedemaetransfert(): ?\DateTime
    {
        return $this->datedemaetransfert;
    }

    public function setDatedemaetransfert(?\DateTime $datedemaetransfert): static
    {
        $this->datedemaetransfert = $datedemaetransfert;

        return $this;
    }

    public function getDateDeMiseAEau(): ?\DateTime
    {
        return $this->dateDeMiseAEau;
    }

    public function setDateDeMiseAEau(?\DateTime $dateDeMiseAEau): static
    {
        $this->dateDeMiseAEau = $dateDeMiseAEau;

        return $this;
    }
}
