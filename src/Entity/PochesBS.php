<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PochesBS
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\PochesBSRepository")
 */
class PochesBS
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
     * @ORM\Column(name="nbrTotaleEnStock", type="integer")
     */
    private $nbrTotaleEnStock;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPoche", type="string", length=255)
     */
    private $nomPoche;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StocksPochesBS", mappedBy="pochesbs",cascade={"persist","remove"})
     */
    private $stockspoches;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Magasins",inversedBy="poches")
     * @ORM\JoinColumn(name="magasin", referencedColumnName="id_magasin",nullable=false)
     */
    private $parc;

    public function __toString()
    {
     return $this->nomPoche;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stockspoches = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nbrTotaleEnStock
     *
     * @param integer $nbrTotaleEnStock
     * @return PochesBS
     */
    public function setNbrTotaleEnStock($nbrTotaleEnStock)
    {
        $this->nbrTotaleEnStock = $nbrTotaleEnStock;

        return $this;
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
     * Set nomPoche
     *
     * @param string $nomPoche
     * @return PochesBS
     */
    public function setNomPoche($nomPoche)
    {
        $this->nomPoche = $nomPoche;

        return $this;
    }

    /**
     * Get nomPoche
     *
     * @return string 
     */
    public function getNomPoche()
    {
        return $this->nomPoche;
    }

    /**
     * Add stockspoches
     *
     * @param \App\Entity\StocksPochesBS $stockspoches
     * @return PochesBS
     */
    public function addStockspoch(\App\Entity\StocksPochesBS $stockspoches)
    {
        $this->stockspoches[] = $stockspoches;

        return $this;
    }

    /**
     * Remove stockspoches
     *
     * @param \App\Entity\StocksPochesBS $stockspoches
     */
    public function removeStockspoch(\App\Entity\StocksPochesBS $stockspoches)
    {
        $this->stockspoches->removeElement($stockspoches);
    }

    /**
     * Get stockspoches
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStockspoches()
    {
        return $this->stockspoches;
    }

    /**
     * Set parc
     *
     * @param \App\Entity\Magasins $parc
     * @return PochesBS
     */
    public function setParc(\App\Entity\Magasins $parc)
    {
        $this->parc = $parc;

        return $this;
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
}
