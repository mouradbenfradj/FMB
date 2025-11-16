<?php

namespace App\Entity;

use App\Repository\FruitDeMerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitDeMerRepository::class)]
class FruitDeMer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Articles>
     */
    #[ORM\OneToMany(targetEntity: Articles::class, mappedBy: 'fruitDeMer', orphanRemoval: true)]
    private Collection $articles;

    /**
     * @var Collection<int, Corde>
     */
    #[ORM\OneToMany(targetEntity: Corde::class, mappedBy: 'fruitDeMer')]
    private Collection $cordes;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->cordes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setFruitDeMer($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getFruitDeMer() === $this) {
                $article->setFruitDeMer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Corde>
     */
    public function getCordes(): Collection
    {
        return $this->cordes;
    }

    public function addCorde(Corde $corde): static
    {
        if (!$this->cordes->contains($corde)) {
            $this->cordes->add($corde);
            $corde->setFruitDeMer($this);
        }

        return $this;
    }

    public function removeCorde(Corde $corde): static
    {
        if ($this->cordes->removeElement($corde)) {
            // set the owning side to null (unless already changed)
            if ($corde->getFruitDeMer() === $this) {
                $corde->setFruitDeMer(null);
            }
        }

        return $this;
    }
}
