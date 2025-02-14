<?php

namespace App\DataFixtures;

use App\Entity\Asc\FiliereComposite\Emplacement;
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
            $flotteurOysterPro = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM flotteur WHERE id = ' . $emplacementData['flotteur_id']);
            $segment = $this->getReference('segment' . $flotteurOysterPro[0]['segment_id']);

            $emplacement = new Emplacement();
            $emplacement->initEmplacement($segment, $emplacementData['place']);
            $emplacement->setSegment($segment);

            $manager->persist($emplacement);
            $this->addReference('emplacement' . $emplacementData['id'], $emplacement);
        }

        $this->ascManager->flush();
    }


    public function getDependencies()
    {
        return array(
            FlotteurSegmentOysterproToAscFixtures::class,
        );
    }

    public static function getGroups(): array
    {
        return ['migration', 'emplacement'];
    }
}
