<?php

namespace App\DataFixtures;

use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AlerteVertFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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

    public function getDependencies()
    {
        return array(
            CycleFixtures::class,
        );
    }
    public function load(ObjectManager $manager): void
    {


        $alerts = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM processus');
        dd($alerts);

        $manager->flush();
    }
}
