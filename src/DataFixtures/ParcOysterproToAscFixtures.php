<?php

namespace App\DataFixtures;

use App\Entity\Asc\Parc;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class ParcOysterproToAscFixtures extends Fixture implements FixtureGroupInterface
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
            $parc = new Parc();
            $parc->initParc(intval($data['id_magasin']), $data['abrev_magasin'], $data['lib_magasin']);
            $this->ascManager->persist($parc);
            $this->addReference($data['id_magasin'], $parc);
        }
        $this->ascManager->flush();
    }

    public static function getGroups(): array
    {
        return ['migration','parc'];
    }
}
