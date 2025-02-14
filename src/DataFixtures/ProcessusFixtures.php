<?php

namespace App\DataFixtures;

use App\Entity\Asc\Alerte\AlerteJaune;
use App\Entity\Asc\Alerte\AlerteRouge;
use App\Entity\Asc\Alerte\AlerteVert;
use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\LifeProcess\Cycle;
use App\Entity\Asc\LifeProcess\Processus;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class ProcessusFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        return ['default', 'processus'];
    }

    public function getDependencies()
    {
        return array(
            PhaseFixtures::class,
        );
    }
    public function load(ObjectManager $manager): void
    {

        $processusOysterPro = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM processus');
        foreach ($processusOysterPro as  $processusDb) {
            /* 
           [
            "id" => "1"
            "nomProcessus" => "Prégrossissement H"
            "duree" => "a:3:{s:5:"jours";i:0;s:4:"mois";i:3;s:5:"annee";i:0;}"
            "articleSortie" => "CORDE HUITRES"
            "id_processus_parent_id" => null
            "ref_article" => "57f7b1e198786"
            "phases_processus_id" => "1"
            "numeroDebCycle" => "1"
            "limiteDuCycle" => "5"
            "abrevProcessus" => "NH"
            "alerteRougeJours" => "a:3:{s:5:"jours";i:0;s:4:"mois";i:0;s:5:"annee";i:0;}"
            "alerteJauneJours" => "a:3:{s:5:"jours";i:-7;s:4:"mois";i:0;s:5:"annee";i:0;}"
            "couleur" => "#00FF00"
            "couleurDuFond" => "#FFFFFF"
            ]
            */
            $phase = $this->getReference('phase' . $processusDb['phases_processus_id']);
            $processus = new Processus();
            $processus->setNomProcessus($processusDb['nomProcessus']);
            $cycle = new Cycle();
            $cycle->setNomCycle($processusDb['nomProcessus']);

            $alertVert = new AlerteVert();
            $alerteVertJours = unserialize($processusDb['duree']);
            $jours = $alerteVertJours['jours'];
            $mois = $alerteVertJours['mois'];
            $annee = $alerteVertJours['annee'];
            $alertVert->setNomAlerte($jours . '-' . $mois . '-' . $annee);
            $alertVert->setAvantNombreJour($jours);
            $alertVert->setAvantNombreMoi($mois);
            $alertVert->setAvantNombreAnnee($annee);
            $cycle->setAlerteVert($alertVert);

            $alertJaune = new AlerteJaune();
            $alerteJauneJours = unserialize($processusDb['alerteJauneJours']);
            $jours = $alerteJauneJours['jours'];
            $mois = $alerteJauneJours['mois'];
            $annee = $alerteJauneJours['annee'];
            $alertJaune->setNomAlerte($jours . '-' . $mois . '-' . $annee);
            $alertJaune->setAvantNombreJour($jours);
            $alertJaune->setAvantNombreMoi($mois);
            $alertJaune->setAvantNombreAnnee($annee);
            $cycle->setAlerteJaune($alertJaune);

            $alertRouge = new AlerteRouge();
            $alerteRougeJours = unserialize($processusDb['alerteRougeJours']);
            $jours = $alerteRougeJours['jours'];
            $mois = $alerteRougeJours['mois'];
            $annee = $alerteRougeJours['annee'];
            $alertRouge->setNomAlerte($jours . '-' . $mois . '-' . $annee);
            $alertRouge->setAvantNombreJour($jours);
            $alertRouge->setAvantNombreMoi($mois);
            $alertRouge->setAvantNombreAnnee($annee);
            $cycle->setAlerteRouge($alertRouge);
            $cycle->setNumDebCycle($processusDb['numeroDebCycle']);
            $cycle->setNumFinCycle($processusDb['limiteDuCycle']);
            $cycle->setCouleurTexte($processusDb['couleur']);
            $cycle->setCouleurFondText($processusDb['couleurDuFond']);
            $processus->addCycle($cycle);
            $processus->setPhase($phase);
            $this->ascManager->persist($processus);
        }
        $manager->flush();
    }
}
