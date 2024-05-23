<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmballageContent
 *
 * @ORM\Table(name="emballage_content", indexes={@ORM\Index(name="IDX_67EEC147787EB836", columns={"emballage_id"})})
 * @ORM\Entity
 */
class EmballageContent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var int
     *
     * @ORM\Column(name="emplacement", type="integer", nullable=false)
     */
    private $emplacement;

    /**
     * @var \Emballage
     *
     * @ORM\ManyToOne(targetEntity="Emballage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emballage_id", referencedColumnName="id")
     * })
     */
    private $emballage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getEmplacement(): ?int
    {
        return $this->emplacement;
    }

    public function setEmplacement(int $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getEmballage(): ?Emballage
    {
        return $this->emballage;
    }

    public function setEmballage(?Emballage $emballage): self
    {
        $this->emballage = $emballage;

        return $this;
    }


}
