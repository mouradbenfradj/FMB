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
use App\Entity\Asc\Stock;
use App\Entity\Asc\FiliereComposite\Segment;
use App\Entity\Asc\FruitDeMer;
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
        $this->parcService->deleteParcCache();
        $oysterProParcFiliere = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM magasins');

        foreach ($oysterProParcFiliere as $data) {
            $parc = new Parc();
            $parc->initParc(intval($data['id_magasin']), $data['abrev_magasin'], $data['lib_magasin']);

            $oysterProStocks = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM stocks WHERE id_stock = ' . intval($data['id_stock']));
            foreach ($oysterProStocks as $stockData) {
                $stock = new Stock();
                $stock->initStock($parc, $stockData['lib_stock'], $stockData['abrev_stock'], $stockData['actif']);
                $parc->addStock($stock);
            }
            $oysterProCorde = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM Corde WHERE magasin = ' . intval($data['id_stock']));
            foreach ($oysterProCorde as $cordeData) {
                $stock = new Corde();
                $stock->initCorde($parc, $stockData['nomCorde'], $stockData['nbrtotaleEnStock']);
                $parc->addCorde($stock);
            }
            $oysterProLanterne = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM lanterne WHERE magasin = ' . intval($data['id_stock']));
            foreach ($oysterProLanterne as $LanterneData) {
                $stock = new Lanterne();
                $stock->initLanterne($parc, $stockData['nomLanterne'], $stockData['nbrtotaleEnStock'], $stockData['nbrpoche']);
                $parc->addLanterne($stock);
            }
            $oysterProPoche = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM Poche WHERE magasin = ' . intval($data['id_stock']));
            foreach ($oysterProPoche as $PocheData) {
                $stock = new Poche();
                $stock->initPoche($parc, $stockData['nomPoche'], $stockData['nbrtotaleEnStock'], $stockData['nbrpoche']);
                $parc->addPoche($stock);
            }
            $manager->persist($parc);

            $filiereData = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM filiere WHERE magasin = ' . intval($data['id_magasin']));
            foreach ($filiereData as $filiereData) {
                $filiere = new Filiere();
                $filiere->initFiliere($parc, $filiereData['nomFiliere'], $filiereData['aireDeTravaille']);
                $manager->persist($filiere);
                $segmentsData = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM segment WHERE filiere_id = ' . intval($filiereData['id']));
                foreach ($segmentsData as $segmentData) {
                    $segment = new Segment();
                    $segment->initSegment($filiere, $segmentData['nomSegment'], $segmentData['longeur']);
                    $manager->persist($segment);
                    $flotteursData = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM flotteur WHERE segment_id = ' . intval($segmentData['id']));
                    foreach ($flotteursData as $flotteurData) {
                        $flotteur = new Flotteur();
                        $flotteur->initFlotteur($segment, $flotteurData['nomFlotteur']);
                        $manager->persist($flotteur);
                        $emplacementsData = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM emplacement WHERE flotteur_id = ' . intval($flotteurData['id']));
                        foreach ($emplacementsData as $emplacementData) {
                            $emplacement = new Emplacement();
                            $emplacement->initEmplacement($flotteur, $emplacementData['place']);
                            $manager->persist($emplacement);
                        }
                    }
                }
            }
        }
        $huitre = new FruitDeMer();
        $huitre->setNom('HUITRES');
        $manager->persist($huitre);
        $moule = new FruitDeMer();
        $moule->setNom('MOULES');
        $manager->persist($moule);
        $manager->flush();

        $oysterProArticles = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM articles WHERE ref_art_categ = \'5a0edf052aa4c\'');
        foreach ($oysterProArticles as $articleData) {
            $article = new Articles();
            $article->initArticle($huitre, $articleData['ref_article'], $articleData['lib_article'], $articleData['desc_courte'], $articleData['desc_longue']);
            $manager->persist($article);
        }
        $oysterProArticles = $this->oysterProConnection->fetchAllAssociative('SELECT * FROM articles WHERE ref_art_categ = \'5a0edf05430f2\'');
        foreach ($oysterProArticles as $articleData) {
            $article = new Articles();
            $article->initArticle($moule, $articleData['ref_article'], $articleData['lib_article'], $articleData['desc_courte'], $articleData['desc_longue']);
            $manager->persist($article);
        }

        $manager->flush();
        $this->parcService->findAllFromParcCache();
    }
}
