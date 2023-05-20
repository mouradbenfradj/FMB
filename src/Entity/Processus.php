<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Processus
 *
 * @ORM\Table(name="processus", indexes={@ORM\Index(name="IDX_EEEA8C1D477FF5A2", columns={"phases_processus_id"}), @ORM\Index(name="IDX_EEEA8C1DC62E5DB6", columns={"ref_article"}), @ORM\Index(name="IDX_EEEA8C1D6AB2EA46", columns={"id_processus_parent_id"})})
 * @ORM\Entity
 */
class Processus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomProcessus", type="string", length=255, nullable=false)
     */
    private $nomprocessus;

    /**
     * @var array
     *
     * @ORM\Column(name="duree", type="array", length=0, nullable=false)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="articleSortie", type="string", length=255, nullable=false)
     */
    private $articlesortie;

    /**
     * @var int
     *
     * @ORM\Column(name="numeroDebCycle", type="integer", nullable=false)
     */
    private $numerodebcycle;

    /**
     * @var int
     *
     * @ORM\Column(name="limiteDuCycle", type="integer", nullable=false)
     */
    private $limiteducycle;

    /**
     * @var string
     *
     * @ORM\Column(name="abrevProcessus", type="string", length=255, nullable=false)
     */
    private $abrevprocessus;

    /**
     * @var array
     *
     * @ORM\Column(name="alerteRougeJours", type="array", length=0, nullable=false)
     */
    private $alerterougejours;

    /**
     * @var array
     *
     * @ORM\Column(name="alerteJauneJours", type="array", length=0, nullable=false)
     */
    private $alertejaunejours;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255, nullable=false)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="couleurDuFond", type="string", length=255, nullable=false)
     */
    private $couleurdufond;

    /**
     * @var \Articles
     *
     * @ORM\ManyToOne(targetEntity="Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_article", referencedColumnName="ref_article")
     * })
     */
    private $refArticle;

    /**
     * @var \Phases
     *
     * @ORM\ManyToOne(targetEntity="Phases")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="phases_processus_id", referencedColumnName="id")
     * })
     */
    private $phasesProcessus;

    /**
     * @var \Processus
     *
     * @ORM\ManyToOne(targetEntity="Processus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_processus_parent_id", referencedColumnName="id")
     * })
     */
    private $idProcessusParent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomprocessus(): ?string
    {
        return $this->nomprocessus;
    }

    public function setNomprocessus(string $nomprocessus): self
    {
        $this->nomprocessus = $nomprocessus;

        return $this;
    }

    public function getDuree(): ?array
    {
        return $this->duree;
    }

    public function setDuree(array $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getArticlesortie(): ?string
    {
        return $this->articlesortie;
    }

    public function setArticlesortie(string $articlesortie): self
    {
        $this->articlesortie = $articlesortie;

        return $this;
    }

    public function getNumerodebcycle(): ?int
    {
        return $this->numerodebcycle;
    }

    public function setNumerodebcycle(int $numerodebcycle): self
    {
        $this->numerodebcycle = $numerodebcycle;

        return $this;
    }

    public function getLimiteducycle(): ?int
    {
        return $this->limiteducycle;
    }

    public function setLimiteducycle(int $limiteducycle): self
    {
        $this->limiteducycle = $limiteducycle;

        return $this;
    }

    public function getAbrevprocessus(): ?string
    {
        return $this->abrevprocessus;
    }

    public function setAbrevprocessus(string $abrevprocessus): self
    {
        $this->abrevprocessus = $abrevprocessus;

        return $this;
    }

    public function getAlerterougejours(): ?array
    {
        return $this->alerterougejours;
    }

    public function setAlerterougejours(array $alerterougejours): self
    {
        $this->alerterougejours = $alerterougejours;

        return $this;
    }

    public function getAlertejaunejours(): ?array
    {
        return $this->alertejaunejours;
    }

    public function setAlertejaunejours(array $alertejaunejours): self
    {
        $this->alertejaunejours = $alertejaunejours;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getCouleurdufond(): ?string
    {
        return $this->couleurdufond;
    }

    public function setCouleurdufond(string $couleurdufond): self
    {
        $this->couleurdufond = $couleurdufond;

        return $this;
    }

    public function getRefArticle(): ?Articles
    {
        return $this->refArticle;
    }

    public function setRefArticle(?Articles $refArticle): self
    {
        $this->refArticle = $refArticle;

        return $this;
    }

    public function getPhasesProcessus(): ?Phases
    {
        return $this->phasesProcessus;
    }

    public function setPhasesProcessus(?Phases $phasesProcessus): self
    {
        $this->phasesProcessus = $phasesProcessus;

        return $this;
    }

    public function getIdProcessusParent(): ?self
    {
        return $this->idProcessusParent;
    }

    public function setIdProcessusParent(?self $idProcessusParent): self
    {
        $this->idProcessusParent = $idProcessusParent;

        return $this;
    }


}
