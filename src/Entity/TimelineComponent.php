<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimelineComponent
 *
 * @ORM\Table(name="timeline__component", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_1B2F01CDD1B862B8", columns={"hash"})})
 * @ORM\Entity
 */
class TimelineComponent
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
     * @ORM\Column(name="model", type="string", length=255, nullable=false)
     */
    private $model;

    /**
     * @var array
     *
     * @ORM\Column(name="identifier", type="array", length=0, nullable=false)
     */
    private $identifier;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=255, nullable=false)
     */
    private $hash;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getIdentifier(): ?array
    {
        return $this->identifier;
    }

    public function setIdentifier(array $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }


}
