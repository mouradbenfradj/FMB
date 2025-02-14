<?php

namespace App\DataFixtures;

use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\Stock;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class StockOysterproToAscFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    private $oysterProManager;
    private $ascManager;
    private $parcCacheService;

    public function __construct(EntityManagerInterface $oysterProManager, EntityManagerInterface $ascManager, ParcCacheService $parcCacheService)
    {
        $this->oysterProManager = $oysterProManager;
        $this->ascManager = $ascManager;
        $this->parcCacheService = $parcCacheService;
    }

    public function load(ObjectManager $manager): void
    {
        $this->parcCacheService->deleteParcCache();
        $oysterProStocks = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM stocks');
        foreach ($oysterProStocks as $stockData) {
            /* 
            [
            "id_stock" => "1"
            "ref_adr_stock" => null
            "lib_stock" => "Stock Parc FMB"
            "abrev_stock" => "SFMB"
            "actif" => "1"
            ]
            */
            $stock = new stock();
            $parc = $this->getReference('parc' . $stockData['id_stock']);
            $stock->initStock($parc, $stockData['lib_stock'], $stockData['abrev_stock'], $stockData['actif']);
            $this->ascManager->persist($stock);
            $this->addReference('stock' . $stockData['id_stock'], $stock);
        }

        $this->ascManager->flush();
    }

    public function getDependencies()
    {
        return array(
            ParcOysterproToAscFixtures::class,
        );
    }

    public static function getGroups(): array
    {
        return ['migration', 'stock'];
    }
}
