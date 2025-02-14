<?php

namespace App\DataFixtures;

use App\Entity\Asc\SonataUserUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = new SonataUserUser();
        $user->setUsername('mourad');
        $user->setEmail('mourad.ben.fradj@gmail.com');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_SUPER_ADMIN']);
        $user->setEnabled(true); // Assurez-vous que cette méthode existe dans votre entité

        // encode the plain password
        $user->setPassword($this->passwordHasher->hashPassword(
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
