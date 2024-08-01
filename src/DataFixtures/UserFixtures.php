<?php

namespace App\DataFixtures;

use App\Entity\Asc\SonataUserUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new SonataUserUser();
        $user->setUsername('mourad');
        $user->setEmail('mourad.ben.fradj@gmail.com');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_SUPER_ADMIN']);

        // encode the plain password
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'mourad'
        ));

        $manager->persist($user);
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['migration', 'user'];
    }
}
