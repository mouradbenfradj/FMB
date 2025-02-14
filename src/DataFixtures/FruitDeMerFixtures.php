<?php

namespace App\DataFixtures;

use App\Entity\Asc\FruitDeMer;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class FruitDeMerFixtures extends Fixture implements FixtureGroupInterface
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
    public static function getGroups(): array
    {
        return ['default'];
    }


    public function load(ObjectManager $manager): void
    {
        $huitre = new FruitDeMer();
        $huitre->setNom('HUITRES');
        $manager->persist($huitre);
        $this->addReference('huitre', $huitre);
        $moule = new FruitDeMer();
        $moule->setNom('MOULES');
        $manager->persist($moule);
        $this->addReference('moule', $moule);
        $manager->flush();
    }
}
