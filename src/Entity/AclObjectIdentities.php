<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AclObjectIdentities
 *
 * @ORM\Table(name="acl_object_identities", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_9407E5494B12AD6EA000B10", columns={"object_identifier", "class_id"})}, indexes={@ORM\Index(name="IDX_9407E54977FA751A", columns={"parent_object_identity_id"})})
 * @ORM\Entity
 */
class AclObjectIdentities
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="class_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $classId;

    /**
     * @var string
     *
     * @ORM\Column(name="object_identifier", type="string", length=100, nullable=false)
     */
    private $objectIdentifier;

    /**
     * @var bool
     *
     * @ORM\Column(name="entries_inheriting", type="boolean", nullable=false)
     */
    private $entriesInheriting;

    /**
     * @var \AclObjectIdentities
     *
     * @ORM\ManyToOne(targetEntity="AclObjectIdentities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_object_identity_id", referencedColumnName="id")
     * })
     */
    private $parentObjectIdentity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AclObjectIdentities", mappedBy="ancestor")
     */
    private $objectIdentity = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->objectIdentity = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassId(): ?int
    {
        return $this->classId;
    }

    public function setClassId(int $classId): self
    {
        $this->classId = $classId;

        return $this;
    }

    public function getObjectIdentifier(): ?string
    {
        return $this->objectIdentifier;
    }

    public function setObjectIdentifier(string $objectIdentifier): self
    {
        $this->objectIdentifier = $objectIdentifier;

        return $this;
    }

    public function isEntriesInheriting(): ?bool
    {
        return $this->entriesInheriting;
    }

    public function setEntriesInheriting(bool $entriesInheriting): self
    {
        $this->entriesInheriting = $entriesInheriting;

        return $this;
    }

    public function getParentObjectIdentity(): ?self
    {
        return $this->parentObjectIdentity;
    }

    public function setParentObjectIdentity(?self $parentObjectIdentity): self
    {
        $this->parentObjectIdentity = $parentObjectIdentity;

        return $this;
    }

    /**
     * @return Collection<int, AclObjectIdentities>
     */
    public function getObjectIdentity(): Collection
    {
        return $this->objectIdentity;
    }

    public function addObjectIdentity(AclObjectIdentities $objectIdentity): self
    {
        if (!$this->objectIdentity->contains($objectIdentity)) {
            $this->objectIdentity[] = $objectIdentity;
            $objectIdentity->addAncestor($this);
        }

        return $this;
    }

    public function removeObjectIdentity(AclObjectIdentities $objectIdentity): self
    {
        if ($this->objectIdentity->removeElement($objectIdentity)) {
            $objectIdentity->removeAncestor($this);
        }

        return $this;
    }

}
