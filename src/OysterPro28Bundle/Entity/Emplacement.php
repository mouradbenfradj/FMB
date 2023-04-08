<?php

namespace OysterPro28Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Tree\Entity\MappedSuperclass\AbstractClosure;

/**
 * Emplacement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="OysterPro28Bundle\Repository\EmplacementRepository")
 */
class Emplacement extends AbstractClosure
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var integer
     *
     * @ORM\Column(name="place", type="integer")
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\Flotteur", inversedBy="emplacements",cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $flotteur;
    /**
     *
     * @ORM\Column(name="date_remplissage", type="date",nullable=true)
     */
    private $dateDeRemplissage;

    /**
     * Get place
     *
     * @return integer
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set place
     *
     * @param integer $place
     * @return Emplacement
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    public function __toString()
    {
        return "".$this->getId();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return "".$this->id;
    }

    /**
     * Get flotteur
     *
     * @return \OysterPro28Bundle\Entity\Flotteur
     */
    public function getFlotteur()
    {
        return $this->flotteur;
    }

    /**
     * Set flotteur
     *
     * @param \OysterPro28Bundle\Entity\Flotteur $flotteur
     * @return Emplacement
     */
    public function setFlotteur(\OysterPro28Bundle\Entity\Flotteur $flotteur)
    {
        $this->flotteur = $flotteur;

        return $this;
    }


    /**
     * Get dateDeRemplissage
     *
     * @return \DateTime
     */
    public function getDateDeRemplissage()
    {
        return $this->dateDeRemplissage;
    }

    /**
     * Set dateDeRemplissage
     *
     * @param \DateTime $dateDeRemplissage
     * @return Emplacement
     */
    public function setDateDeRemplissage($dateDeRemplissage)
    {
        $this->dateDeRemplissage = $dateDeRemplissage;

        return $this;
    }

}
