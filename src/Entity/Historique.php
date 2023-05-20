<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique
 *
 * @ORM\Table(name="historique", indexes={@ORM\Index(name="IDX_EDBFD5ECFB88E14F", columns={"utilisateur_id"})})
 * @ORM\Entity
 */
class Historique
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateOp", type="datetime", nullable=false)
     */
    private $dateop;

    /**
     * @var string
     *
     * @ORM\Column(name="operation", type="string", length=255, nullable=false)
     */
    private $operation;

    /**
     * @var array|null
     *
     * @ORM\Column(name="tache_effectuer", type="array", length=0, nullable=true)
     */
    private $tacheEffectuer;

    /**
     * @var \FosUserUser
     *
     * @ORM\ManyToOne(targetEntity="FosUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     * })
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateop(): ?\DateTimeInterface
    {
        return $this->dateop;
    }

    public function setDateop(\DateTimeInterface $dateop): self
    {
        $this->dateop = $dateop;

        return $this;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(string $operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    public function getTacheEffectuer(): ?array
    {
        return $this->tacheEffectuer;
    }

    public function setTacheEffectuer(?array $tacheEffectuer): self
    {
        $this->tacheEffectuer = $tacheEffectuer;

        return $this;
    }

    public function getUtilisateur(): ?FosUserUser
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?FosUserUser $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }


}
