<?php

namespace OysterPro28Bundle\Entity;
use Gedmo\Mapping\Annotation as Gedmo;

use Gedmo\Tree\Entity\MappedSuperclass\AbstractClosure;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flotteur
 * @Gedmo\Tree(type="nested")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="OysterPro28Bundle\Repository\FlotteurRepository")
 */
class Flotteur extends AbstractClosure
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
     * @ORM\Column(name="nomFlotteur", type="string", length=255)
     */
    private $nomFlotteur;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="OysterPro28Bundle\Entity\Segment", inversedBy="flotteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $segment;

    /**
     * @ORM\OneToMany(targetEntity="OysterPro28Bundle\Entity\Emplacement", mappedBy="flotteur",cascade={"persist","remove"},fetch="LAZY")
     */
    private $emplacements;

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
        $this->emplacements = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\PrePersist
     */
    public function generateEmplacement()
    {
        for ($j = 1; $j < 11; $j++) {
            $emplacement = new Emplacement();
            $emplacement->setPlace($j);
            $this->addEmplacement($emplacement);
        }
    }

    /**
     * Add emplacements
     *
     * @param \OysterPro28Bundle\Entity\Emplacement $emplacements
     * @return Flotteur
     */
    public function addEmplacement(\OysterPro28Bundle\Entity\Emplacement $emplacements)
    {
        $this->emplacements[] = $emplacements;
        $emplacements->setFlotteur($this);

        return $this;
    }

    public function __toString()
    {
        return $this->nomFlotteur;
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
     * Get nomFlotteur
     *
     * @return string
     */
    public function getNomFlotteur()
    {
        return $this->nomFlotteur;
    }

    /**
     * Set nomFlotteur
     *
     * @param string $nomFlotteur
     * @return Flotteur
     */
    public function setNomFlotteur($nomFlotteur)
    {
        $this->nomFlotteur = $nomFlotteur;

        return $this;
    }

    /**
     * Get segment
     *
     * @return \OysterPro28Bundle\Entity\Segment
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * Set segment
     *
     * @param \OysterPro28Bundle\Entity\Segment $segment
     * @return Flotteur
     */
    public function setSegment(\OysterPro28Bundle\Entity\Segment $segment)
    {
        $this->segment = $segment;
        return $this;
    }

    /**
     * Remove emplacements
     *
     * @param \OysterPro28Bundle\Entity\Emplacement $emplacements
     */
    public function removeEmplacement(\OysterPro28Bundle\Entity\Emplacement $emplacements)
    {
        $this->emplacements->removeElement($emplacements);
    }

    /**
     * Get emplacements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmplacements()
    {
        return $this->emplacements;
    }
}
