<?php

namespace App\DataFixtures;

use App\Entity\Asc\Emplacement;
use App\Entity\Asc\Filiere;
use App\Entity\Asc\Flotteur;
use App\Entity\Asc\Parc;
use App\Entity\Asc\Segment;
use App\Service\ParcService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\DBAL\Connection;

class OysterproToAscFixtures extends Fixture
{
    
    private $oysterProConnection;
    private $ascConnection;
    private $parcService;

    public function __construct(Connection $oysterProConnection, Connection $ascConnection, ParcService $parcService)
    {
        $this->oysterProConnection = $oysterProConnection;
        $this->ascConnection = $ascConnection;
        $this->parcService = $parcService;
    }

    public function load(ObjectManager $manager): void
    {
        $oysterProData = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM magasins');

        foreach ($oysterProData as $data) {
            $parc = new Parc();
            $parc->setIdParc(intval($data['id_magasin']));
            $parc->setLibParc($data['lib_magasin']);
            $parc->setAbrevParc($data['abrev_magasin']);
            $manager->persist($parc);
            $filiereData = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM filiere WHERE magasin = '.intval($data['id_magasin']));
            foreach ($filiereData as $filiereData) {
                $filiere = new Filiere();
                $filiere->setNomFiliere($filiereData['nomFiliere']);
                $filiere->setAireDeTravaille($filiereData['aireDeTravaille']);
                //$filiere->setObservation($filiereData['observation']);
                $filiere->setParc($parc);
                $manager->persist($filiere);
                $segmentsData = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM segment WHERE filiere_id = '.intval($filiereData['id']));
                foreach ($segmentsData as $segmentData) {
                    $segment = new Segment();
                    $segment->setLongeur($segmentData['longeur']);
                    $segment->setNomSegment($segmentData['nomSegment']);
                    $segment->setFiliere($filiere);
                    $manager->persist($segment);
                    $flotteursData = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM flotteur WHERE segment_id = '.intval($segmentData['id']));
                    foreach ($flotteursData as $flotteurData) {
                        $flotteur = new Flotteur();
                        $flotteur->setNomFlotteur($flotteurData['nomFlotteur']);
                        $flotteur->setSegment($segment);
                        $manager->persist($flotteur);
                        $emplacementsData = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM emplacement WHERE flotteur_id = '.intval($flotteurData['id']));
                        foreach ($emplacementsData as $emplacementData) {
                            $emplacement = new Emplacement();
                            $emplacement->setFlotteur($flotteur);
                            $emplacement->setPlace($emplacementData['place']);
                            $manager->persist($emplacement);
                        }

                    }
                }
            }
        }
        $manager->flush();
        $this->parcService->findAllFromParcCache();
    }
}
