<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phases
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\PhasesRepository")
 */
class Phases
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nomPhase", type="string", length=255)
     */
    private $nomPhase;
    /**
     * @var integer
     *
     * @ORM\Column(name="ordeDaffichage", type="integer")
     */
    private $ordeDaffichage;

    public function __toString()
    {
        return $this->nomPhase;
    }

    /**
     * Set nomPhase
     *
     * @param string $nomPhase
     * @return Phases
     */
    public function setNomPhase($nomPhase)
    {
        $this->nomPhase = $nomPhase;

        return $this;
    }

    /**
     * Get nomPhase
     *
     * @return string
     */
    public function getNomPhase()
    {
        return $this->nomPhase;
    }

    /**
     * Set ordeDaffichage
     *
     * @param integer $ordeDaffichage
     * @return Phases
     */
    public function setOrdeDaffichage($ordeDaffichage)
    {
        $this->ordeDaffichage = $ordeDaffichage;

        return $this;
    }

    /**
     * Get ordeDaffichage
     *
     * @return integer
     */
    public function getOrdeDaffichage()
    {
        return $this->ordeDaffichage;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
