<?php

namespace App\DataFixtures;

use App\Entity\Asc\FiliereComposite\Emplacement;
use App\Entity\Asc\FiliereComposite\Flotteur;
use App\Entity\Asc\FiliereComposite\Segment;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class FlotteurOysterproToAscFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        $flotteursData = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM flotteur');
        foreach ($segmentsData as $segmentData) {
            $segment = new Segment();
            $filiere = $this->getReference('filiere' . $segmentData['filiere_id']);
            $segment->initSegment($filiere, $segmentData['nomSegment'],0, $segmentData['longeur']);
            $manager->getClassMetadata(get_class($segment))->setLifecycleCallbacks(array());
            $manager->persist($segment);
        }

        foreach ($flotteursData as $flotteurData) {
            $flotteur = new Flotteur();
            $flotteur->initFlotteur($segment, $flotteurData['nomFlotteur']);
            $emplacementsData = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM emplacement WHERE flotteur_id = ' . intval($flotteurData['id']));
            foreach ($emplacementsData as $emplacementData) {
                $emplacement = new Emplacement();
                $emplacement->initEmplacement($flotteur, $emplacementData['place']);
                $flotteur->addEmplacement($emplacement);
            }
            $segment->addFlotteur($flotteur);
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
