<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    // ...
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('mourad');
        $user->setEmail('mourad.ben.fradj@gmail.com');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setSuperAdmin(true);
        $user->setPlainPassword('mourad');

        $password = $this->hasher->hashPassword($user, 'mourad');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
