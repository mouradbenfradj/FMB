<?php

namespace App\Tests\Controller;

use App\Entity\Emplacement;
use App\Entity\Segment;
use App\Entity\Filiere;
use App\Entity\StockCorde;
use App\Entity\Corde;
use App\Entity\FruitDeMer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Twig\Environment;

class TemplateRenderingTest extends KernelTestCase
{
    public function testTooltipRendering(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $twig = $container->get(Environment::class);

        // Mock objects
        $filiere = new Filiere();
        $filiere->setNomFiliere('Filiere Test');

        $segment = new Segment();
        $segment->setNomSegment('Segment Test');
        $segment->setFiliere($filiere);
        $segment->setLongeur(100);
        $segment->setPasEmplacement(1);

        $fruitDeMer = new FruitDeMer();
        $fruitDeMer->setNom('huitre');

        $corde = new Corde();
        $corde->setNom('Corde Test');
        $corde->setLongeur(2);
        $corde->setFruitDeMer($fruitDeMer);

        $stockMateriel = $this->createMock(StockCorde::class);
        $stockMateriel->method('getDateDeMiseAEau')->willReturn(new \DateTime('-10 months'));
        $stockMateriel->method('getCorde')->willReturn($corde);
        $stockMateriel->method('getquantite')->willReturn(100);

        $emplacement = new Emplacement();
        $emplacement->setPlace(1);
        $emplacement->setStockMateriel($stockMateriel);

        $html = $twig->render('emplacement/_emplacement_tooltip.html.twig', [
            'emplacement' => $emplacement,
            'segment' => $segment
        ]);

        $this->assertStringContainsString('📍 Emplacement #1', $html);
        $this->assertStringContainsString('Segment Test', $html);
        $this->assertStringContainsString('10', $html);
        $this->assertStringContainsString('mois', $html);
        $this->assertStringContainsString('HUITRE', $html);
        $this->assertStringContainsString('Survie:', $html);
    }
}
