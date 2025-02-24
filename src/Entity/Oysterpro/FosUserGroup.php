<?php

namespace App\Entity\Oysterpro;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FosUserGroup
 *
 * @ORM\Table(name="fos_user_group", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_583D1F3E5E237E06", columns={"name"})})
 * @ORM\Entity
 */
class FosUserGroup
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", length=0, nullable=false)
     */
    private $roles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="FosUserUser", mappedBy="group")
     */
    private $user = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection<int, FosUserUser>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(FosUserUser $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->addGroup($this);
        }

        return $this;
    }

    public function removeUser(FosUserUser $user): self
    {
        if ($this->user->removeElement($user)) {
            $user->removeGroup($this);
        }

        return $this;
    }

}
