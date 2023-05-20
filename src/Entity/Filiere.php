<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filiere
 *
 * @ORM\Table(name="filiere", indexes={@ORM\Index(name="IDX_2ED05D9E54AF5F27", columns={"magasin"})})
 * @ORM\Entity
 */
class Filiere
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
     * @var string
     *
     * @ORM\Column(name="nomFiliere", type="string", length=255, nullable=false)
     */
    private $nomfiliere;

    /**
     * @var bool
     *
     * @ORM\Column(name="aireDeTravaille", type="boolean", nullable=false)
     */
    private $airedetravaille;

    /**
     * @var array|null
     *
     * @ORM\Column(name="observation", type="array", length=0, nullable=true)
     */
    private $observation;

    /**
     * @var \Magasins
     *
     * @ORM\ManyToOne(targetEntity="Magasins")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="magasin", referencedColumnName="id_magasin")
     * })
     */
    private $magasin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomfiliere(): ?string
    {
        return $this->nomfiliere;
    }

    public function setNomfiliere(string $nomfiliere): self
    {
        $this->nomfiliere = $nomfiliere;

        return $this;
    }

    public function isAiredetravaille(): ?bool
    {
        return $this->airedetravaille;
    }

    public function setAiredetravaille(bool $airedetravaille): self
    {
        $this->airedetravaille = $airedetravaille;

        return $this;
    }

    public function getObservation(): ?array
    {
        return $this->observation;
    }

    public function setObservation(?array $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getMagasin(): ?Magasins
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasins $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }


}
