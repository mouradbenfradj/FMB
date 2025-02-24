<?php

namespace App\Entity\Oysterpro;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclClasses
 *
 * @ORM\Table(name="acl_classes", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_69DD750638A36066", columns={"class_type"})})
 * @ORM\Entity
 */
class AclClasses
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
     * @var string
     *
     * @ORM\Column(name="class_type", type="string", length=200, nullable=false)
     */
    private $classType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassType(): ?string
    {
        return $this->classType;
    }

    public function setClassType(string $classType): self
    {
        $this->classType = $classType;

        return $this;
    }


}
