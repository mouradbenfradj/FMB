<?php

namespace App\Entity\Asc;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
class Processus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomProcessus;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroDebCycle;

    /**
     * @ORM\Column(type="integer")
     */
    private $limiteDuCycle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $abrevProcessus;

    /**
     * @ORM\Column(type="object")
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $articleSortie;

    /**
     * @var int|null
     *
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @var int|null
     *
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @var int|null
     *
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @var self|null
     *
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Processus")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @var self|null
     *
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Processus", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @var Collection<int, Processus>
     *
     * @ORM\OneToMany(targetEntity="Processus", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProcessus(): ?string
    {
        return $this->nomProcessus;
    }

    public function setNomProcessus(string $nomProcessus): self
    {
        $this->nomProcessus = $nomProcessus;

        return $this;
    }

    public function getNumeroDebCycle(): ?int
    {
        return $this->numeroDebCycle;
    }

    public function setNumeroDebCycle(int $numeroDebCycle): self
    {
        $this->numeroDebCycle = $numeroDebCycle;

        return $this;
    }

    public function getLimiteDuCycle(): ?int
    {
        return $this->limiteDuCycle;
    }

    public function setLimiteDuCycle(int $limiteDuCycle): self
    {
        $this->limiteDuCycle = $limiteDuCycle;

        return $this;
    }

    public function getAbrevProcessus(): ?string
    {
        return $this->abrevProcessus;
    }

    public function setAbrevProcessus(string $abrevProcessus): self
    {
        $this->abrevProcessus = $abrevProcessus;

        return $this;
    }

    public function getDuree(): ?object
    {
        return $this->duree;
    }

    public function setDuree(object $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getArticleSortie(): ?string
    {
        return $this->articleSortie;
    }

    public function setArticleSortie(string $articleSortie): self
    {
        $this->articleSortie = $articleSortie;

        return $this;
    }
    
    public function getRoot(): ?self
    {
        return $this->root;
    }

    public function setParent(self $parent = null): void
    {
        $this->parent = $parent;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }
}
