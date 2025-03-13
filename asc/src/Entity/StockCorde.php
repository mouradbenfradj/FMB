<?php

namespace App\Entity;

use App\Repository\StockCordeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockCordeRepository::class)]
class StockCorde
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantiter = null;

    #[ORM\Column]
    private ?float $poid = 0;

    #[ORM\Column]
    private ?float $longeur = null;

    #[ORM\ManyToOne(inversedBy: 'stockCordes')]
    private ?Emplacement $emplacement = null;

    #[ORM\ManyToOne(inversedBy: 'stockCordes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Corde $corde = null;

    #[ORM\ManyToOne(inversedBy: 'stockCordes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StockArticleSn $stockArticleSn = null;

    #[ORM\Column]
    private ?bool $pret = false;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedecreation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datederetirement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datederetraittransfert = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datedemaetransfert = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDeMiseAEau = null;

    #[ORM\Column]
    private ?bool $chaussement = false;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateassemblage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datechaussement = null;

    public function __toString()
    {
        return $this->corde->getNom();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiter(): ?int
    {
        return $this->quantiter;
    }

    public function setQuantiter(int $quantiter): static
    {
        $this->quantiter = $quantiter;

        return $this;
    }

    public function getPoid(): ?float
    {
        return $this->poid;
    }

    public function setPoid(float $poid): static
    {
        $this->poid = $poid;

        return $this;
    }

    public function getLongeur(): ?float
    {
        return $this->longeur;
    }

    public function setLongeur(float $longeur): static
    {
        $this->longeur = $longeur;

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

    public function getCorde(): ?Corde
    {
        return $this->corde;
    }

    public function setCorde(?Corde $corde): static
    {
        $this->corde = $corde;

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

    public function isPret(): ?bool
    {
        return $this->pret;
    }

    public function setPret(bool $pret): static
    {
        $this->pret = $pret;

        return $this;
    }

    public function getDatedecreation(): ?\DateTimeInterface
    {
        return $this->datedecreation;
    }

    public function setDatedecreation(\DateTimeInterface $datedecreation): static
    {
        $this->datedecreation = $datedecreation;

        return $this;
    }

    public function getDatederetirement(): ?\DateTimeInterface
    {
        return $this->datederetirement;
    }

    public function setDatederetirement(?\DateTimeInterface $datederetirement): static
    {
        $this->datederetirement = $datederetirement;

        return $this;
    }

    public function getDatederetraittransfert(): ?\DateTimeInterface
    {
        return $this->datederetraittransfert;
    }

    public function setDatederetraittransfert(?\DateTimeInterface $datederetraittransfert): static
    {
        $this->datederetraittransfert = $datederetraittransfert;

        return $this;
    }

    public function getDatedemaetransfert(): ?\DateTimeInterface
    {
        return $this->datedemaetransfert;
    }

    public function setDatedemaetransfert(?\DateTimeInterface $datedemaetransfert): static
    {
        $this->datedemaetransfert = $datedemaetransfert;

        return $this;
    }

    public function getDateDeMiseAEau(): ?\DateTimeInterface
    {
        return $this->dateDeMiseAEau;
    }

    public function setDateDeMiseAEau(?\DateTimeInterface $dateDeMiseAEau): static
    {
        $this->dateDeMiseAEau = $dateDeMiseAEau;

        return $this;
    }

    public function isChaussement(): ?bool
    {
        return $this->chaussement;
    }

    public function setChaussement(bool $chaussement): static
    {
        $this->chaussement = $chaussement;

        return $this;
    }

    public function getDateassemblage(): ?\DateTimeInterface
    {
        return $this->dateassemblage;
    }

    public function setDateassemblage(?\DateTimeInterface $dateassemblage): static
    {
        $this->dateassemblage = $dateassemblage;

        return $this;
    }

    public function getDatechaussement(): ?\DateTimeInterface
    {
        return $this->datechaussement;
    }

    public function setDatechaussement(?\DateTimeInterface $datechaussement): static
    {
        $this->datechaussement = $datechaussement;

        return $this;
    }
}
