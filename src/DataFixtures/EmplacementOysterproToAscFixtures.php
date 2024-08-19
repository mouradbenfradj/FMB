<?php

namespace App\DataFixtures;

use App\Entity\Asc\FiliereComposite\Emplacement;
use App\Entity\Asc\FiliereComposite\Flotteur;
use App\Entity\Asc\FiliereComposite\FlotteurSegment;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class EmplacementOysterproToAscFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        $emplacementsData = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM emplacement');
        foreach ($emplacementsData as $emplacementData) {
            $flotteur = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM flotteur WHERE id = ' . $emplacementData['flotteur_id']);
            $segment = $this->getReference('segment' . $flotteur[0]['segment_id']);
            $emplacement = new Emplacement();
            $emplacement->initEmplacement($segment, $emplacementData['place']);
            $manager->persist($emplacement);
        }
        $this->ascManager->flush();
    }

    public function getDependencies()
    {
        return array(
            SegmentOysterproToAscFixtures::class,
        );
    }

    public static function getGroups(): array
    {
        return ['migration', 'emplacement'];
    }
}
