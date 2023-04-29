<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Corde
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\CordeRepository")
 */
class Corde
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
     * @ORM\Column(name="nbrtotaleEnStock", type="integer")
     */
    private $nbrTotaleEnStock;
    /**
     * @var string
     * @ORM\Column(name="nomCorde", type="string", length=255)
     */
    private $nomCorde;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StocksCordes", mappedBy="corde",cascade={"persist","remove"})
     */
    private $stockscordes;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Magasins",inversedBy="cordes")
     * @ORM\JoinColumn(name="magasin", referencedColumnName="id_magasin",nullable=false)
     */
    private $parc;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stockscordes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get nbrTotaleEnStock
     *
     * @return integer
     */
    public function getNbrTotaleEnStock()
    {
        return $this->nbrTotaleEnStock;
    }

    /**
     * Set nbrTotaleEnStock
     *
     * @param integer $nbrTotaleEnStock
     * @return Corde
     */
    public function setNbrTotaleEnStock($nbrTotaleEnStock)
    {
        $this->nbrTotaleEnStock = $nbrTotaleEnStock;

        return $this;
    }

    /**
     * Add stockscordes
     *
     * @param \App\Entity\StocksCordes $stockscordes
     * @return Corde
     */
    public function addStockscorde(\App\Entity\StocksCordes $stockscordes)
    {
        $this->stockscordes[] = $stockscordes;

        return $this;
    }

    /**
     * Remove stockscordes
     *
     * @param \App\Entity\StocksCordes $stockscordes
     */
    public function removeStockscorde(\App\Entity\StocksCordes $stockscordes)
    {
        $this->stockscordes->removeElement($stockscordes);
    }

    /**
     * Get stockscordes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStockscordes()
    {
        return $this->stockscordes;
    }

    /**
     * Get parc
     *
     * @return \App\Entity\Magasins
     */
    public function getParc()
    {
        return $this->parc;
    }

    /**
     * Set parc
     *
     * @param \App\Entity\Magasins $parc
     * @return Corde
     */
    public function setParc(\App\Entity\Magasins $parc)
    {
        $this->parc = $parc;

        return $this;
    }

    /**
     * Get nomCorde
     *
     * @return string
     */
    public function getNomCorde()
    {
        return $this->nomCorde;
    }

    /**
     * Set nomCorde
     *
     * @param string $nomCorde
     * @return Corde
     */
    public function setNomCorde($nomCorde)
    {
        $this->nomCorde = $nomCorde;

        return $this;
    }

    public function __toString()
    {
        return $this->nomCorde;
    }
}
