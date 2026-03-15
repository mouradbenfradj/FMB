<?php

namespace App\Tests\Controller;

use App\Entity\Parc;
use App\Service\Cache\ParcCacheService;
use App\Service\EtatActuelProd\EtatActuelProdService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class RetraitTransfertControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();

        $parc = new Parc();
        $parc->setAbrevParc('TEST');
        
        $reflection = new \ReflectionClass($parc);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($parc, 1);

        $parcCache = $this->createMock(ParcCacheService::class);
        $parcCache->method('getAllParcsWithRelations')->willReturn([$parc]);
        $parcCache->method('getParcFromCache')->willReturn($parc);

        $etatActuelProd = $this->createMock(EtatActuelProdService::class);
        $etatActuelProd->method('getFiliereArrayStat')->willReturn([
            'REF', 50, 60, 100, 10, 5, 5, 2, 1, 1, 0, 0, null, 0, 100, 200
        ]);

        $client->getContainer()->set(ParcCacheService::class, $parcCache);
        $client->getContainer()->set(EtatActuelProdService::class, $etatActuelProd);

        $client->request('GET', '/retrait-transfert/1');

        self::assertResponseIsSuccessful();
    }
}
