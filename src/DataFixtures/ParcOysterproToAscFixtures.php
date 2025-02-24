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
            switch ($data['abrev_magasin']) {
                case 'FMB':
                    $abrev_magasin = 'TTF';
                    $lib_magasin = 'Ferme TTF';
                    break;
                case 'MARINOR':
                    $abrev_magasin = 'TSF';
                    $lib_magasin = 'Ferme TSF';
                    break;

                default:
                    $abrev_magasin = $data['abrev_magasin'];
                    $lib_magasin = $data['lib_magasin'];
                    break;
            }
            $parc->initParc($abrev_magasin, $lib_magasin);

            $this->ascManager->persist($parc);
            $this->addReference('parc' . $data['id_magasin'], $parc);
        }
        $this->ascManager->flush();
    }

    public static function getGroups(): array
    {
        return ['migration', 'parc'];
    }
}
