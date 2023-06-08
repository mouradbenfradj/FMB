<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimelineAction
 *
 * @ORM\Table(name="timeline__action")
 * @ORM\Entity
 */
class TimelineAction
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
     * @ORM\Column(name="verb", type="string", length=255, nullable=false)
     */
    private $verb;

    /**
     * @var string
     *
     * @ORM\Column(name="status_current", type="string", length=255, nullable=false)
     */
    private $statusCurrent;

    /**
     * @var string
     *
     * @ORM\Column(name="status_wanted", type="string", length=255, nullable=false)
     */
    private $statusWanted;

    /**
     * @var string|null
     *
     * @ORM\Column(name="duplicate_key", type="string", length=255, nullable=true)
     */
    private $duplicateKey;

    /**
     * @var int|null
     *
     * @ORM\Column(name="duplicate_priority", type="integer", nullable=true)
     */
    private $duplicatePriority;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVerb(): ?string
    {
        return $this->verb;
    }

    public function setVerb(string $verb): self
    {
        $this->verb = $verb;

        return $this;
    }

    public function getStatusCurrent(): ?string
    {
        return $this->statusCurrent;
    }

    public function setStatusCurrent(string $statusCurrent): self
    {
        $this->statusCurrent = $statusCurrent;

        return $this;
    }

    public function getStatusWanted(): ?string
    {
        return $this->statusWanted;
    }

    public function setStatusWanted(string $statusWanted): self
    {
        $this->statusWanted = $statusWanted;

        return $this;
    }

    public function getDuplicateKey(): ?string
    {
        return $this->duplicateKey;
    }

    public function setDuplicateKey(?string $duplicateKey): self
    {
        $this->duplicateKey = $duplicateKey;

        return $this;
    }

    public function getDuplicatePriority(): ?int
    {
        return $this->duplicatePriority;
    }

    public function setDuplicatePriority(?int $duplicatePriority): self
    {
        $this->duplicatePriority = $duplicatePriority;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


}
