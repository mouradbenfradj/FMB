<?php

namespace App\Entity\Asc;

use App\Repository\Asc\SonataUserUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser;

/**
 * @ORM\Entity(repositoryClass=SonataUserUserRepository::class)
 */
class SonataUserUser extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
