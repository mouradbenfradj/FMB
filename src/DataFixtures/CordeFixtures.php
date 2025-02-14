<?php

namespace App\DataFixtures;

use App\Entity\Asc\Conteneur\Corde;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class CordeFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        return ['default', 'corde'];
    }

    public function getDependencies()
    {
        return array(
            ParcOysterproToAscFixtures::class,
        );
    }
    public function load(ObjectManager $manager): void
    {

        $cordesOysterPro = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM corde');
        foreach ($cordesOysterPro as $cordeOysterPro) {
            /*
             [
            "id" => "1"
            "magasin" => "1"
            "nbrtotaleEnStock" => "9563"
            "nomCorde" => "CORDE M 3M"
            ] */
            $parc = $this->getReference('parc' . $cordeOysterPro['magasin']);
            $corde = new Corde();
            $corde->initCorde($parc, $cordeOysterPro['nomCorde'], $cordeOysterPro['nbrtotaleEnStock']);
            $this->ascManager->persist($corde);
            $this->addReference('corde' . $cordeOysterPro['id'], $corde);
        }
        $manager->flush();
    }
}
