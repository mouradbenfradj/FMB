<?php

namespace App\DataFixtures;

use App\Entity\Asc\Conteneur\Lanterne;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class LanterneFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        return ['default', 'lanterne'];
    }

    public function getDependencies()
    {
        return array(
            ParcOysterproToAscFixtures::class,
        );
    }
    public function load(ObjectManager $manager): void
    {

        $lanternesOysterPro = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM lanterne');
        foreach ($lanternesOysterPro as $lanterneOysterPro) {
            /* 
            [
            "magasin" => "1"
            "nomLanterne" => "LANTERNE 10P"
            "nbrpoche" => "10"
            "nbrtotaleEnStock" => "3"
            ] 
            */
            $parc = $this->getReference('parc' . $lanterneOysterPro['magasin']);
            $lanterne = new Lanterne();
            $lanterne->initLanterne($parc, $lanterneOysterPro['nomLanterne'], $lanterneOysterPro['nbrtotaleEnStock'], $lanterneOysterPro['nbrpoche']);
            $this->ascManager->persist($lanterne);
            $this->addReference('lanterne' . $lanterneOysterPro['nomLanterne'], $lanterne);
        }
        $manager->flush();
    }
}
