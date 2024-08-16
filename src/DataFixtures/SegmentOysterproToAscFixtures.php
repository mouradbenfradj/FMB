<?php

namespace App\DataFixtures;

use App\Entity\Asc\FiliereComposite\Segment;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class SegmentOysterproToAscFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        $segmentsData = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM segment');
        foreach ($segmentsData as $segmentData) {
            $segment = new Segment();
            $filiere = $this->getReference('filiere' . $segmentData['filiere_id']);
            $segment->initSegment($filiere, $segmentData['nomSegment'],0, $segmentData['longeur']);
            $manager->getClassMetadata(get_class($segment))->setLifecycleCallbacks(array());
            $manager->persist($segment);
            $this->addReference('segment' . $segmentData['id'], $segment);
        }
        $this->ascManager->flush();
    }

    public function getDependencies()
    {
        return array(
            FiliereOysterproToAscFixtures::class,
        );
    }

    public static function getGroups(): array
    {
        return ['migration', 'segment'];
    }
}
