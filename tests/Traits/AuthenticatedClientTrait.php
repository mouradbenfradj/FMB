<?php

namespace App\Tests\Traits;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

trait AuthenticatedClientTrait
{
    /**
     * Crée un client authentifié avec un utilisateur admin
     */
    protected function createAuthenticatedClient(): KernelBrowser
    {
        $client = static::createClient();

        // Créer/préparer l'utilisateur admin
        $this->createAdminUser();

        // Se connecter via formulaire Sonata
        $this->loginViaSonataForm($client);

        return $client;
    }

    /**
     * Se connecter via formulaire Sonata
     */
    protected function loginViaSonataForm(KernelBrowser $client): void
    {
        $crawler = $client->request('GET', '/admin/login');
        $form = $crawler->selectButton('Connexion')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';

        $client->submit($form);
        $client->followRedirect(); // Suivre la redirection après login
    }

    /**
     * Crée un utilisateur admin dans la base de test
     */
    protected function createAdminUser(): void
    {
        $entityManager = self::getContainer()->get('doctrine')->getManager();
        $passwordHasher = self::getContainer()->get('security.password_hasher_factory');

        $userRepo = $entityManager->getRepository(User::class);
        $user = $userRepo->findOneBy(['username' => 'admin']);

        if (!$user) {
            $user = new User();
            $user->setUsername('admin');
            $user->setEmail('admin@example.com');
            $user->setEnabled(true);
            $user->setRoles(['ROLE_ADMIN', 'ROLE_SONATA_ADMIN']);

            $encoder = $passwordHasher->getPasswordHasher($user);
            $hashedPassword = $encoder->hashPassword($user, 'admin');
            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();
        }
    }

    /**
     * Crée un client avec un utilisateur spécifique
     */
    protected function createAuthenticatedClientWithUser(
        string $username = 'admin',
        array $roles = ['ROLE_ADMIN', 'ROLE_SONATA_ADMIN'],
        string $password = 'admin'
    ): KernelBrowser {
        $client = static::createClient();

        // Créer l'utilisateur spécifique
        $this->createUser($username, $roles, $password);

        // Se connecter
        $this->loginWithUser($client, $username, $password);

        return $client;
    }

    protected function createUser(string $username, array $roles, string $password): void
    {
        $entityManager = self::getContainer()->get('doctrine')->getManager();
        $passwordHasher = self::getContainer()->get('security.password_hasher_factory');

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($username . '@example.com');
        $user->setEnabled(true);
        $user->setRoles($roles);

        $encoder = $passwordHasher->getPasswordHasher($user);
        $hashedPassword = $encoder->hashPassword($user, $password);
        $user->setPassword($hashedPassword);

        $entityManager->persist($user);
        $entityManager->flush();
    }

    protected function loginWithUser(KernelBrowser $client, string $username, string $password): void
    {
        $crawler = $client->request('GET', '/admin/login');
        $form = $crawler->selectButton('Connexion')->form();
        $form['_username'] = $username;
        $form['_password'] = $password;

        $client->submit($form);
        $client->followRedirect();
    }
}
