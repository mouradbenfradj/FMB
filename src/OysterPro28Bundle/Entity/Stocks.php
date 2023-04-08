<?php
/**
 * Created by PhpStorm.
 * User: moura
 * Date: 01/11/2017
 * Time: 11:59
 */

namespace OysterPro28Bundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Stocks
 *
 * @ORM\Table(name="stocks", indexes={@ORM\Index(name="actif", columns={"actif"}), @ORM\Index(name="ref_adr_stock", columns={"ref_adr_stock"})})
 * @ORM\Entity
 */
class Stocks
{
    /**
     * @var string
     *
     * @ORM\Column(name="lib_stock", type="string", length=32, nullable=false)
     */
    private $libStock;

    /**
     * @var string
     *
     * @ORM\Column(name="abrev_stock", type="string", length=32, nullable=false)
     */
    private $abrevStock;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_adr_stock", type="string", length=32, nullable=true)
     */
    private $refAdrStock;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false)
     */
    private $actif;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_stock", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStock;


}
