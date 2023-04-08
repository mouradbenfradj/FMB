<?php

namespace SS\FMBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmballageContent
 *
 * @ORM\Table()
 */
class EmballageContent
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
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;
    /**
     * @var integer
     *
     * @ORM\Column(name="emplacement", type="integer")
     */
    private $emplacement;
    /**
     * @ORM\ManyToOne(targetEntity="SS\FMBBundle\Entity\Emballage", inversedBy="emballageContent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $emballage;

    public function __toString()
    {
        return "" . $this->id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setQuantite(0);
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

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return EmballageContent
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set emplacement
     *
     * @param integer $emplacement
     * @return EmballageContent
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    /**
     * Get emplacement
     *
     * @return integer 
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * Set emballage
     *
     * @param \SS\FMBBundle\Entity\Emballage2 $emballage
     * @return EmballageContent
     */
    public function setEmballage(\SS\FMBBundle\Entity\Emballage2 $emballage)
    {
        $this->emballage = $emballage;

        return $this;
    }

    /**
     * Get emballagecontent
     *
     * @return \SS\FMBBundle\Entity\Emballage2
     */
    public function getEmballage()
    {
        return $this->emballage;
    }
}
