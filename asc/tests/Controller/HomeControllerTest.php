<?php

namespace App\Tests\Controller;

use App\Entity\Parc;
use App\Repository\ParcRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeControllerTest extends WebTestCase
{
    public function testIndexDefaultRoute(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('#topnav-dashboard', 'Tableau de bord');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > div > ol > li:nth-child(2) > a', 'Tableau de bord');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > h4', 'Tous les parcs');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > div > ol > li.breadcrumb-item.active.chosenParc', 'Tous les parcs');
        $this->assertSelectorTextContains('#wrapper > div.navbar-custom > div > ul.list-unstyled.topnav-menu.topnav-menu-left.m-0 > li.dropdown.d-none.d-xl-block > a', 'Tous les parcs');
    }

    public function testIndexHomeRoute(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/home');

        $this->assertResponseIsSuccessful();


        $this->assertSelectorTextContains('#topnav-dashboard', 'Tableau de bord');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > div > ol > li:nth-child(2) > a', 'Tableau de bord');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > h4', 'Tous les parcs');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > div > ol > li.breadcrumb-item.active.chosenParc', 'Tous les parcs');
        $this->assertSelectorTextContains('#wrapper > div.navbar-custom > div > ul.list-unstyled.topnav-menu.topnav-menu-left.m-0 > li.dropdown.d-none.d-xl-block > a', 'Tous les parcs');
    }
    public function testIndexHomeParcRouteWithValidParc(): void
    {
        $client = static::createClient();

        // Mock ParcRepository
        $parc = new Parc();
        $parc->setAbrevParc('teste');
        $parc->setLibParc('teste');

        // Utiliser Reflection pour définir l'ID
        $reflection = new \ReflectionClass($parc);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($parc, 1); // Définir l'ID à 1

        $parcRepository = $this->createMock(ParcRepository::class);
        $parcRepository->expects($this->once())
            ->method('findAll')
            ->willReturn([$parc]);

        $parcRepository->expects($this->once())
            ->method('find')
            ->with(1) // Assurez-vous que l'ID correspond
            ->willReturn($parc);

        $client->getContainer()->set(ParcRepository::class, $parcRepository);

        // Effectuez la requête
        $crawler = $client->request('GET', '/home/1');

        // Vérifiez que la réponse est réussie
        $this->assertResponseIsSuccessful();

        // Vérifiez que le contenu du template est correct
        $this->assertSelectorTextContains('#topnav-dashboard', 'Tableau de bord');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > div > ol > li:nth-child(2) > a', 'Tableau de bord');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > h4', 'teste');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > div > ol > li.breadcrumb-item.active.chosenParc', 'teste');
        $this->assertSelectorTextContains('#wrapper > div.navbar-custom > div > ul.list-unstyled.topnav-menu.topnav-menu-left.m-0 > li.dropdown.d-none.d-xl-block > a', 'teste');
        $this->assertSelectorTextContains(
            '#swup > div:nth-child(1) > div:nth-child(1) > div > div > div:nth-child(2) > div > h3 > span[data-plugin="counterup"]',
            '1'
        );
    }


    public function testIndexHomeParcRouteWithInvalidParc(): void
    {
        $client = static::createClient();

        // Mock ParcRepository
        $parcRepository = $this->createMock(ParcRepository::class);
        $parcRepository->expects($this->once())
            ->method('findAll')
            ->willReturn([]); // Aucun parc trouvé

        $parcRepository->expects($this->once())
            ->method('find')
            ->with(999) // ID d'un parc qui n'existe pas
            ->willReturn(null); // Simuler un parc invalide

        $client->getContainer()->set(ParcRepository::class, $parcRepository);

        // Effectuez la requête pour un parc invalide
        $crawler = $client->request('GET', '/home/999');

        // Vérifiez que la réponse est réussie
        $this->assertResponseIsSuccessful();

        // Vérifiez que le contenu du template est correct pour un parc invalide
        $this->assertSelectorTextContains('#topnav-dashboard', 'Tableau de bord');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > div > ol > li:nth-child(2) > a', 'Tableau de bord');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > h4', 'Tous les parcs');
        $this->assertSelectorTextContains('#wrapper > div.content-page > div > div > aside > div > div > div > ol > li.breadcrumb-item.active.chosenParc', 'Tous les parcs');
        $this->assertSelectorTextContains('#wrapper > div.navbar-custom > div > ul.list-unstyled.topnav-menu.topnav-menu-left.m-0 > li.dropdown.d-none.d-xl-block > a', 'Tous les parcs');
    }


    public function testNumberOfParcsDisplayed(): void
    {
        $client = static::createClient();

        // Mock ParcRepository avec 4 parcs
        $parcs = [];
        for ($i = 1; $i <= 4; $i++) {
            $parc = new Parc();
            $parc->setAbrevParc('Parc ' . $i);
            $parc->setLibParc('Parc ' . $i);

            // Utiliser Reflection pour définir l'ID
            $reflection = new \ReflectionClass($parc);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($parc, $i); // Définir l'ID

            $parcs[] = $parc;
        }

        $parcRepository = $this->createMock(ParcRepository::class);
        $parcRepository->expects($this->once())
            ->method('findAll')
            ->willReturn($parcs); // Retourner 4 parcs

        $client->getContainer()->set(ParcRepository::class, $parcRepository);

        // Effectuez la requête
        $client->request('GET', '/');

        // Vérifiez que la réponse est réussie
        $this->assertResponseIsSuccessful();

        // Vérifiez que le nombre de parcs affichés est 4
        $this->assertSelectorTextContains(
            '#swup > div:nth-child(1) > div:nth-child(1) > div > div > div:nth-child(2) > div > h3 > span[data-plugin="counterup"]',
            '4'
        );
    }
}
