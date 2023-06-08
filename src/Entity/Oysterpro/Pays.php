<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays", uniqueConstraints={@ORM\UniqueConstraint(name="pays", columns={"pays"})})
 * @ORM\Entity
 */
class Pays
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pays", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPays;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=64, nullable=false)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="code_pays", type="string", length=2, nullable=false)
     */
    private $codePays;

    /**
     * @var bool
     *
     * @ORM\Column(name="defaut_id_langage", type="boolean", nullable=false)
     */
    private $defautIdLangage;

    /**
     * @var bool
     *
     * @ORM\Column(name="use_etat", type="boolean", nullable=false)
     */
    private $useEtat;

    /**
     * @var bool
     *
     * @ORM\Column(name="affichage", type="boolean", nullable=false)
     */
    private $affichage;

    public function getIdPays(): ?int
    {
        return $this->idPays;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getCodePays(): ?string
    {
        return $this->codePays;
    }

    public function setCodePays(string $codePays): self
    {
        $this->codePays = $codePays;

        return $this;
    }

    public function isDefautIdLangage(): ?bool
    {
        return $this->defautIdLangage;
    }

    public function setDefautIdLangage(bool $defautIdLangage): self
    {
        $this->defautIdLangage = $defautIdLangage;

        return $this;
    }

    public function isUseEtat(): ?bool
    {
        return $this->useEtat;
    }

    public function setUseEtat(bool $useEtat): self
    {
        $this->useEtat = $useEtat;

        return $this;
    }

    public function isAffichage(): ?bool
    {
        return $this->affichage;
    }

    public function setAffichage(bool $affichage): self
    {
        $this->affichage = $affichage;

        return $this;
    }


}
