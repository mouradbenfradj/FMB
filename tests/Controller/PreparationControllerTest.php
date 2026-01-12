<?php

namespace App\Tests\Controller;

use App\Entity\Parc;
use App\Repository\ParcRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PreparationControllerTest extends WebTestCase
{
    public function testPreparationCorde(): void
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

        // Set session
        $client->getContainer()->get('request_stack')->getSession()->set('selected_parc_id', 1);

        $client->request('GET', '/preparationCorde/1');

        self::assertResponseIsSuccessful();
    }

    public function testPreparationCordePost(): void
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

        // Set session
        $client->getContainer()->get('request_stack')->getSession()->set('selected_parc_id', 1);

        // Submit the form with minimal data (this may need adjustment based on form requirements)
        $crawler = $client->request('POST', '/preparationCorde/1', [
            'preparation_corde' => [
                'longeur' => 10,
                'datedecreation' => '2023-01-01',
                'densite' => 5,
                'nombre' => 10,
                // Add other required fields as needed
            ]
        ]);

        // Check for redirect or success
        self::assertResponseRedirects('/home');
        $client->followRedirect();
        self::assertSelectorTextContains('.alert-success', 'Your changes were saved!');
    }
}
