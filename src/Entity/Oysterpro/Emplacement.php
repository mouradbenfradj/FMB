<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emplacement
 *
 * @ORM\Table(name="emplacement", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_C0CF65F6787EB836", columns={"emballage_id"})}, indexes={@ORM\Index(name="IDX_C0CF65F69AE7A92D", columns={"flotteur_id"})})
 * @ORM\Entity
 */
class Emplacement
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
     * @ORM\Column(name="place", type="integer", nullable=false)
     */
    private $place;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_remplissage", type="date", nullable=true)
     */
    private $dateRemplissage;

    /**
     * @var \Emballage
     *
     * @ORM\ManyToOne(targetEntity="Emballage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emballage_id", referencedColumnName="id")
     * })
     */
    private $emballage;

    /**
     * @var \Flotteur
     *
     * @ORM\ManyToOne(targetEntity="Flotteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="flotteur_id", referencedColumnName="id")
     * })
     */
    private $flotteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getDateRemplissage(): ?\DateTimeInterface
    {
        return $this->dateRemplissage;
    }

    public function setDateRemplissage(?\DateTimeInterface $dateRemplissage): self
    {
        $this->dateRemplissage = $dateRemplissage;

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

    public function getFlotteur(): ?Flotteur
    {
        return $this->flotteur;
    }

    public function setFlotteur(?Flotteur $flotteur): self
    {
        $this->flotteur = $flotteur;

        return $this;
    }


}
