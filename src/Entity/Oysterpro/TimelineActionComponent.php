<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimelineActionComponent
 *
 * @ORM\Table(name="timeline__action_component", indexes={@ORM\Index(name="IDX_6ACD1B169D32F035", columns={"action_id"}), @ORM\Index(name="IDX_6ACD1B16E2ABAFFF", columns={"component_id"})})
 * @ORM\Entity
 */
class TimelineActionComponent
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
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=true)
     */
    private $text;

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
     *   @ORM\JoinColumn(name="component_id", referencedColumnName="id")
     * })
     */
    private $component;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

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

    public function getComponent(): ?TimelineComponent
    {
        return $this->component;
    }

    public function setComponent(?TimelineComponent $component): self
    {
        $this->component = $component;

        return $this;
    }


}
