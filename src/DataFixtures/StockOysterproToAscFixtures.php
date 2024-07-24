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
        $oysterProParcFiliere = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM magasins');
        foreach ($oysterProParcFiliere as $data) {
            $oysterProStocks = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM stocks WHERE id_stock = ' . intval($data['id_stock']));
            foreach ($oysterProStocks as $stockData) {
                $stock = new stock();
                $parc = $this->getReference($data['id_magasin']);
                $stock->initStock($parc, $stockData['lib_stock'], $stockData['abrev_stock'], $stockData['actif']);
                $this->ascManager->persist($stock);
            }
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
