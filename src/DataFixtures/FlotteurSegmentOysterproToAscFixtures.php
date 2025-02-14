<?php

namespace App\DataFixtures;

use App\Entity\Asc\FiliereComposite\FlotteurSegment;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class FlotteurSegmentOysterproToAscFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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

        // Déclarer le tableau en dehors de la boucle
        $paslastFlotteurSegmentBySegment = [];

        $this->parcCacheService->deleteParcCache();
        $flotteursOysterPro = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM flotteur');
        foreach ($flotteursOysterPro as $flotteurOysterPro) {
            $flotteur = $this->getReference('flotteur' . substr($flotteurOysterPro['nomFlotteur'], 0, 1));
            $segment = $this->getReference('segment' . $flotteurOysterPro['segment_id']);
            if (!isset($paslastFlotteurSegmentBySegment[$flotteurOysterPro['segment_id']])) {
                $paslastFlotteurSegmentBySegment[$flotteurOysterPro['segment_id']] = 0;
            }

            $flotteurSegment = new FlotteurSegment();
            $flotteurSegment->initFlotteurSegment($segment, $flotteur, 1, $paslastFlotteurSegmentBySegment[$flotteurOysterPro['segment_id']], $paslastFlotteurSegmentBySegment[$flotteurOysterPro['segment_id']] + 10);
            $flotteurSegment->setSegment($segment);
            $manager->persist($flotteurSegment);
            $this->addReference('flotteurSegment' . $flotteurOysterPro['id'], $flotteurSegment);
            $paslastFlotteurSegmentBySegment[$flotteurOysterPro['segment_id']] +=  ($segment->getPas() * 10);
        }

        $this->ascManager->flush();
    }

    public function getDependencies()
    {
        return array(
            FlotteurOysterproToAscFixtures::class,
        );
    }

    public static function getGroups(): array
    {
        return ['migration', 'FlotteurSegment'];
    }
}
