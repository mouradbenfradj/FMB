<?php

namespace App\DataFixtures;

use App\Entity\Asc\FiliereComposite\Flotteur;
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
        $arrayFlotteur = [];

        foreach ($flotteursData as $flotteurData) {
            if (!isset($arrayFlotteur[substr($flotteurData['nomFlotteur'], 0, 1)])) {
                $flotteur = new Flotteur();
                $nomFlotteur = substr($flotteurData['nomFlotteur'], 0, 1);
                switch ($nomFlotteur) {
                    case 'A':
                        $flotteur->initFlotteur($nomFlotteur, 200, 2, 400);
                        break;
                    case 'B':
                        $flotteur->initFlotteur($nomFlotteur, 50, 2.5, 125);
                        break;

                    default:
                        $flotteur->initFlotteur($nomFlotteur, 0, 0, 0);
                        break;
                }
                $manager->getClassMetadata(get_class($flotteur))->setLifecycleCallbacks(array());
                $manager->persist($flotteur);
                $arrayFlotteur[$nomFlotteur] = $flotteur;
                $this->addReference('flotteur' . $nomFlotteur, $flotteur);
            }
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
        return ['migration', 'flotteur'];
    }
}
