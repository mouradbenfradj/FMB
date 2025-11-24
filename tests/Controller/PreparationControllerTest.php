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

        $client->request('GET', '/preparationCorde/1');

        self::assertResponseIsSuccessful();
    }
}
