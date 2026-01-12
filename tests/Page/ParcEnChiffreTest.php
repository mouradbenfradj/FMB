<?php

namespace App\Tests\Page;

use App\Tests\Traits\AuthenticatedClientTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParcEnChiffreTest extends WebTestCase
{
    use AuthenticatedClientTrait;

    public function testIndexDefaultRoute(): void
    {
        $client = $this->createAuthenticatedClient();

        // Tester l'accès à la page d'accueil
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('#topnav-dashboard', 'Parc en chiffres');
    }
    /* 
    public function testAdminDashboard(): void
    {
        $client = $this->createAuthenticatedClient();

        $crawler = $client->request('GET', '/admin/dashboard');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.content-header', 'Dashboard');
    } */
    /* 
    public function testWithDifferentUser(): void
    {
        // Créer un client avec un utilisateur spécifique
        $client = $this->createAuthenticatedClientWithUser(
            'manager',
            ['ROLE_MANAGER'],
            'manager123'
        );

        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    } */
}
