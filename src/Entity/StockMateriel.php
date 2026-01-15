<?php

namespace App\Entity;

use App\Entity\StockCorde;
use App\Entity\Emplacement;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\StockLanterne;
use App\Entity\StockArticleSn;
use Doctrine\DBAL\Types\Types;
use App\Repository\StockMaterielRepository;

#[ORM\Entity(repositoryClass: StockMaterielRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['corde' => StockCorde::class, 'lanterne' => StockLanterne::class])]
abstract class StockMateriel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    protected ?\DateTime $datedecreation = null;

    #[ORM\OneToOne(inversedBy: 'stockMateriel')]
    protected ?Emplacement $emplacement = null;

    #[ORM\ManyToOne(inversedBy: 'stockMateriels')]
    #[ORM\JoinColumn(nullable: false)]
    protected ?StockArticleSn $stockArticleSn = null;

    #[ORM\Column]
    protected ?bool $pret = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    protected ?\DateTime $datederetirement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    protected ?\DateTime $datederetraittransfert = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    protected ?\DateTime $datedemaetransfert = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    protected ?\DateTime $dateDeMiseAEau = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedecreation(): ?\DateTime
    {
        return $this->datedecreation;
    }

    public function setDatedecreation(?\DateTime $datedecreation): void
    {
        $this->datedecreation = $datedecreation;
    }

    public function getEmplacement(): ?Emplacement
    {
        return $this->emplacement;
    }

    public function setEmplacement(?Emplacement $emplacement): void
    {
        $this->emplacement = $emplacement;
    }

    public function getStockArticleSn(): ?StockArticleSn
    {
        return $this->stockArticleSn;
    }

    public function setStockArticleSn(?StockArticleSn $stockArticleSn): void
    {
        $this->stockArticleSn = $stockArticleSn;
    }

    public function isPret(): ?bool
    {
        return $this->pret;
    }

    public function setPret(bool $pret): void
    {
        $this->pret = $pret;
    }

    public function getDatederetirement(): ?\DateTime
    {
        return $this->datederetirement;
    }

    public function setDatederetirement(?\DateTime $datederetirement): void
    {
        $this->datederetirement = $datederetirement;
    }

    public function getDatederetraittransfert(): ?\DateTime
    {
        return $this->datederetraittransfert;
    }

    public function setDatederetraittransfert(?\DateTime $datederetraittransfert): void
    {
        $this->datederetraittransfert = $datederetraittransfert;
    }

    public function getDatedemaetransfert(): ?\DateTime
    {
        return $this->datedemaetransfert;
    }

    public function setDatedemaetransfert(?\DateTime $datedemaetransfert): void
    {
        $this->datedemaetransfert = $datedemaetransfert;
    }

    public function getDateDeMiseAEau(): ?\DateTime
    {
        return $this->dateDeMiseAEau;
    }

    public function setDateDeMiseAEau(?\DateTime $dateDeMiseAEau): void
    {
        $this->dateDeMiseAEau = $dateDeMiseAEau;
    }

    abstract public function __toString(): string;
}
