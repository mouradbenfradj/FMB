<?php

namespace App\DataFixtures;

use App\Entity\Asc\LifeProcess\Phase;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class PhaseFixtures extends Fixture implements FixtureGroupInterface
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
        return ['default', 'phase'];
    }

    public function load(ObjectManager $manager): void
    {

        $phasesDb = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM phases');
        foreach ($phasesDb as $phaseDb) {
            /* 
             [
            "id" => "1"
            "nomPhase" => "Prégrossissement"
            "ordeDaffichage" => "1"
            ]
            */
            $phase = new Phase();
            $phase->setNomPhase($phaseDb['nomPhase']);
            $phase->setOrdreAffichage($phaseDb['ordeDaffichage']);
            $this->ascManager->persist($phase);
            $this->addReference('phase' . $phaseDb['id'], $phase);
        }
        $manager->flush();
    }
}
