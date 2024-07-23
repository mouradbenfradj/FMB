<?php

namespace App\DataFixtures;

use App\Entity\Asc\Articles;
use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Conteneur\Lanterne;
use App\Entity\Asc\Conteneur\Poche;
use App\Entity\Asc\FiliereComposite\Emplacement;
use App\Entity\Asc\FiliereComposite\Filiere;
use App\Entity\Asc\FiliereComposite\Flotteur;
use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\Stock;
use App\Entity\Asc\FiliereComposite\Segment;
use App\Entity\Asc\FruitDeMer;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\DBAL\Connection;

class ParcOysterproToAscFixtures extends Fixture implements FixtureGroupInterface
{

    private $oysterProConnection;
    private $ascConnection;
    private $parcCacheService;

    public function __construct(Connection $oysterProConnection, Connection $ascConnection, ParcCacheService $parcCacheService)
    {
        $this->oysterProConnection = $oysterProConnection;
        $this->ascConnection = $ascConnection;
        $this->parcCacheService = $parcCacheService;
    }

    public function load(ObjectManager $manager): void
    {
        $this->parcCacheService->deleteParcCache();
        $oysterProParcFiliere = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM magasins');
        foreach ($oysterProParcFiliere as $data) {
            $parc = new Parc();
            $parc->initParc(intval($data['id_magasin']), $data['abrev_magasin'], $data['lib_magasin']);
            $manager->persist($parc);
        }
        $manager->flush();
    }
    public static function getGroups(): array
    {
        return ['parc'];
    }
}
