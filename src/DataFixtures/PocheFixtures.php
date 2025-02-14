<?php

namespace App\DataFixtures;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Conteneur\Poche;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class PocheFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        return ['default', 'poche'];
    }

    public function getDependencies()
    {
        return array(
            ParcOysterproToAscFixtures::class,
        );
    }
    public function load(ObjectManager $manager): void
    {

        $pochesBsOysterPro = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM poches_bs');
        foreach ($pochesBsOysterPro as $pocheBsOysterPro) {
            /*
            [
            "id" => "1"
            "magasin" => "1"
            "nbrTotaleEnStock" => "660"
            "nomPoche" => "POCHES HUITRES"
            ]
            */
            $parc = $this->getReference('parc' . $pocheBsOysterPro['magasin']);
            $pocheBs = new Poche();
            $pocheBs->initpoche($parc, $pocheBsOysterPro['nomPoche'], $pocheBsOysterPro['nbrTotaleEnStock']);
            $this->ascManager->persist($pocheBs);
            $this->addReference('pocheBs' . $pocheBsOysterPro['id'], $pocheBs);
        }
        $manager->flush();
    }
}
