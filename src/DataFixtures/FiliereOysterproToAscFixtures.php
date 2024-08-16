<?php

namespace App\DataFixtures;

use App\Entity\Asc\FiliereComposite\Emplacement;
use App\Entity\Asc\FiliereComposite\Filiere;
use App\Entity\Asc\FiliereComposite\Flotteur;
use App\Entity\Asc\FiliereComposite\Segment;
use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\Stock;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class FiliereOysterproToAscFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        $filiereDatas = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM filiere');
        foreach ($filiereDatas as $data) {
            $filiere = new Filiere();
            $parc = $this->getReference($data['magasin']);
            $filiere->initFiliere($parc, $data['nomFiliere'], $data['aireDeTravaille']);
            $manager->persist($filiere);
            $this->addReference('filiere' . $data['id'], $filiere);
        }
        $this->ascManager->flush();
    }

    public function getDependencies()
    {
        return array(
            ParcOysterproToAscFixtures::class,
        );
    }

    public static function getGroups(): array
    {
        return ['migration', 'filiere'];
    }
}
