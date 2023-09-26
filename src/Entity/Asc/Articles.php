<?php

namespace App\Entity\Asc;

use App\Repository\Asc\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $refArticle;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $libArticle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descCourte;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descLongue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefArticle(): ?string
    {
        return $this->refArticle;
    }

    public function setRefArticle(string $refArticle): self
    {
        $this->refArticle = $refArticle;

        return $this;
    }

    public function getLibArticle(): ?string
    {
        return $this->libArticle;
    }

    public function setLibArticle(string $libArticle): self
    {
        $this->libArticle = $libArticle;

        return $this;
    }

    public function getDescCourte(): ?string
    {
        return $this->descCourte;
    }

    public function setDescCourte(?string $descCourte): self
    {
        $this->descCourte = $descCourte;

        return $this;
    }

    public function getDescLongue(): ?string
    {
        return $this->descLongue;
    }

    public function setDescLongue(?string $descLongue): self
    {
        $this->descLongue = $descLongue;

        return $this;
    }
}
