<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimelineTimeline
 *
 * @ORM\Table(name="timeline__timeline", indexes={@ORM\Index(name="IDX_FFBC6AD523EDC87", columns={"subject_id"}), @ORM\Index(name="type_idx", columns={"type"}), @ORM\Index(name="IDX_FFBC6AD59D32F035", columns={"action_id"}), @ORM\Index(name="context_idx", columns={"context"})})
 * @ORM\Entity
 */
class TimelineTimeline
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
     * @ORM\Column(name="context", type="string", length=255, nullable=false)
     */
    private $context;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \TimelineAction
     *
     * @ORM\ManyToOne(targetEntity="TimelineAction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_id", referencedColumnName="id")
     * })
     */
    private $action;

    /**
     * @var \TimelineComponent
     *
     * @ORM\ManyToOne(targetEntity="TimelineComponent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     * })
     */
    private $subject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setContext(string $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getAction(): ?TimelineAction
    {
        return $this->action;
    }

    public function setAction(?TimelineAction $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getSubject(): ?TimelineComponent
    {
        return $this->subject;
    }

    public function setSubject(?TimelineComponent $subject): self
    {
        $this->subject = $subject;

        return $this;
    }


}
