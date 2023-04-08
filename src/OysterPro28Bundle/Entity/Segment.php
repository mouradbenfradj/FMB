<?php

namespace OysterPro28Bundle\Entity;
use Gedmo\Mapping\Annotation as Gedmo;

use Gedmo\Tree\Entity\MappedSuperclass\AbstractClosure;

use Doctrine\ORM\Mapping as ORM;

/**
 * Segment
 * @Gedmo\Tree(type="nested")
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="OysterPro28Bundle\Repository\SegmentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Segment extends AbstractClosure
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
     * @ORM\Column(length=64)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="nomSegment", type="string", length=255)
     */
    private $nomSegment;
    /**
     * @var float
     *
     * @ORM\Column(name="longeur", type="decimal",scale=2)
     */
    private $longeur;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\Filiere", inversedBy="segments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filiere;
    /**
     * @ORM\OneToMany(targetEntity="OysterPro28Bundle\Entity\Flotteur", mappedBy="segment",cascade={"persist","merge","remove"},fetch="LAZY")
     */
    private $flotteurs;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer")
     */
    private $lft;


    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer")
     */
    private $lvl;
    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer")
     */
    private $rgt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->flotteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->filiere . ' ' . $this->getNomSegment();
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get nomSegment
     *
     * @return string
     */
    public function getNomSegment()
    {
        return $this->nomSegment;
    }

    /**
     * Set nomSegment
     *
     * @param string $nomSegment
     * @return Segment
     */
    public function setNomSegment($nomSegment)
    {
        $this->nomSegment = $nomSegment;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function generateFlotteur()
    {
        $nb = $this->getLongeur() / 5;
        for ($i = 0; $i < $nb; $i++) {
            $flotteur = new Flotteur();
            $flotteur->setNomFlotteur($this->nomSegment . $i);
            $this->addFlotteur($flotteur);
        }
    }

    /**
     * Get longeur
     *
     * @return string
     */
    public function getLongeur()
    {
        return $this->longeur;
    }

    /**
     * Set longeur
     *
     * @param string $longeur
     * @return Segment
     */
    public function setLongeur($longeur)
    {
        $this->longeur = $longeur;

        return $this;
    }

    /**
     * Add flotteurs
     *
     * @param \OysterPro28Bundle\Entity\Flotteur $flotteurs
     * @return Segment
     */
    public function addFlotteur(\OysterPro28Bundle\Entity\Flotteur $flotteurs)
    {
        $this->flotteurs[] = $flotteurs;
        $flotteurs->setSegment($this);
        return $this;
    }

    /**
     * @ORM\PostUpdate()
     */
    public function correcteurFlotteur()
    {
        $annb = count($this->flotteurs);
        $nb = (($this->getLongeur() / 5) - count($this->flotteurs));
        if ($nb > 0) {
            for ($i = ($annb - 1); $i < ($annb + $nb); $i++) {
                $flotteur = new Flotteur();
                $flotteur->setNomFlotteur($this->nomSegment . $i);
                $this->addFlotteur($flotteur);
            }
        } else {
            var_dump($nb);
        }
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
     * Get filiere
     *
     * @return \OysterPro28Bundle\Entity\Filiere
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * Set filiere
     *
     * @param \OysterPro28Bundle\Entity\Filiere $filiere
     * @return Segment
     */
    public function setFiliere(\OysterPro28Bundle\Entity\Filiere $filiere)
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * Remove flotteurs
     *
     * @param \OysterPro28Bundle\Entity\Flotteur $flotteurs
     */
    public function removeFlotteur(\OysterPro28Bundle\Entity\Flotteur $flotteurs)
    {
        $this->flotteurs->removeElement($flotteurs);
    }

    /**
     * Get flotteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFlotteurs()
    {
        return $this->flotteurs;
    }
}
