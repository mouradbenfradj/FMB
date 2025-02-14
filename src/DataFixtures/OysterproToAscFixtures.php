<?php

namespace App\DataFixtures;

use App\Entity\Asc\FiliereComposite\Emplacement;
use App\Entity\Asc\FiliereComposite\Filiere;
use App\Entity\Asc\FiliereComposite\Flotteur;
use App\Entity\Asc\FiliereComposite\FlotteurSegment;
use App\Entity\Asc\Parc;
use App\Entity\Asc\Stock\Stock;
use App\Entity\Asc\FiliereComposite\Segment;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class OysterproToAscFixtures extends Fixture implements FixtureGroupInterface
{

    public static function getGroups(): array
    {
        return ['oldMigration', 'parc'];
    }

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
            $parc->initParc($data['abrev_magasin'], $data['lib_magasin']);
            $filiereData = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM filiere WHERE magasin = ' . intval($data['id_magasin']));
            foreach ($filiereData as $filiereData) {
                $filiere = new Filiere();
                $filiere->initFiliere($parc, $filiereData['nomFiliere'], $filiereData['aireDeTravaille']);
                $manager->getClassMetadata(get_class($filiere))->setLifecycleCallbacks(array());
                $segmentsData = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM segment WHERE filiere_id = ' . intval($filiereData['id']));
                foreach ($segmentsData as $segmentData) {
                    $flotteursCount = $this->oysterProManager->getConnection()->fetchOne('SELECT COUNT(*) FROM flotteur WHERE segment_id = ' . $segmentData['id']);
                    $segment = new Segment();
                    $pasEmplacement = $segmentData['longeur'] / ($flotteursCount * 10);
                    $manager->getClassMetadata(get_class($segment))->setLifecycleCallbacks(array());
                    $segment->initSegment($filiere, $segmentData['nomSegment'], $pasEmplacement, $segmentData['longeur']);
                    $flotteursData = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM flotteur WHERE segment_id = ' . intval($segmentData['id']));
                    $lastFlotteurSegment = new FlotteurSegment();
                    $filiere->addSegment($segment);

                    foreach ($flotteursData as $flotteurData) {
                        if (!isset($arrayFlotteur[substr($flotteurData['nomFlotteur'], 0, 1)])) {
                            $flotteur = new Flotteur();
                            $flotteur->initFlotteur(substr($flotteurData['nomFlotteur'], 0, 1), 0, 0, 0);
                            $arrayFlotteur[substr($flotteurData['nomFlotteur'], 0, 1)] = $flotteur;
                        }
                        $manager->persist($flotteur);
                        if (!isset($arraySegment[$segment->getId()])) {
                            $arraySegment[$segment->getId()] = 0;
                        }
                        $lastFlotteurSegment->setPas($arraySegment[$segment->getId()]);

                        $flotteurSegment = new FlotteurSegment();
                        $flotteurSegment->initFlotteurSegment($segment, $arrayFlotteur[substr($flotteurData['nomFlotteur'], 0, 1)], 1, $lastFlotteurSegment->getPas(), ($segment->getPas() * 10));
                        $manager->persist($flotteurSegment);
                        $arraySegment[$segment->getId()] = $lastFlotteurSegment->getPas() + ($segment->getPas() * 10);
                        $manager->getClassMetadata(get_class($flotteur))->setLifecycleCallbacks(array());
                        $manager->getClassMetadata(get_class($flotteurSegment))->setLifecycleCallbacks(array());

                        $emplacementsData = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM emplacement WHERE flotteur_id = ' . intval($flotteurData['id']));
                        $counter = 0; // Initialize a counter to track emplacements

                        foreach ($emplacementsData as $key => $emplacementData) {
                            $emplacement = new Emplacement();
                            $manager->getClassMetadata(get_class($emplacement))->setLifecycleCallbacks(array());
                            $emplacement->initEmplacement($segment, $emplacementData['place']);
                            $counter++;

                            if ($emplacementData['place'] == 1) {
                                $flotteurSegment->setEmplacement($emplacement);
                            } else
                                $segment->addEmplacement($emplacement);
                        }
                    }
                }
                $manager->persist($filiere);
            }
            $oysterProStocks = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM stocks WHERE id_stock = ' . intval($data['id_stock']));
            foreach ($oysterProStocks as $stockData) {
                $stock = new stock();
                $stock->initStock($parc, $stockData['lib_stock'], $stockData['abrev_stock'], $stockData['actif']);
                $parc->addStock($stock);
            }
            /* $oysterProCorde = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM Corde WHERE magasin = ' . intval($data['id_stock']));
            foreach ($oysterProCorde as $cordeData) {
                $stock = new Corde();
                $stock->initCorde($parc, $stockData['nomCorde'], $stockData['nbrtotaleEnStock']);
                $parc->addCorde($stock);
            }
            $oysterProLanterne = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM lanterne WHERE magasin = ' . intval($data['id_stock']));
            foreach ($oysterProLanterne as $LanterneData) {
                $stock = new Lanterne();
                $stock->initLanterne($parc, $stockData['nomLanterne'], $stockData['nbrtotaleEnStock'], $stockData['nbrpoche']);
                $parc->addLanterne($stock);
            } */
            /* $oysterProPoche = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM Poche WHERE magasin = ' . intval($data['id_stock']));
            foreach ($oysterProPoche as $PocheData) {
                $stock = new Poche();
                $stock->initPoche($parc, $stockData['nomPoche'], $stockData['nbrtotaleEnStock'], $stockData['nbrpoche']);
                $parc->addPoche($stock);
            }
            $manager->persist($parc); */
        }/* 
        $huitre = new FruitDeMer();
        $huitre->setNom('HUITRES');
        $manager->persist($huitre);
        $moule = new FruitDeMer();
        $moule->setNom('MOULES');
        $manager->persist($moule);
        $manager->flush();

        $oysterProArticles = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM articles WHERE ref_art_categ = \'5a0edf052aa4c\'');
        foreach ($oysterProArticles as $articleData) {
            $article = new Articles();
            $article->initArticle($huitre, $articleData['ref_article'], $articleData['lib_article'], $articleData['desc_courte'], $articleData['desc_longue']);
            $manager->persist($article);
        }
        $oysterProArticles = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM articles WHERE ref_art_categ = \'5a0edf05430f2\'');
        foreach ($oysterProArticles as $articleData) {
            $article = new Articles();
            $article->initArticle($moule, $articleData['ref_article'], $articleData['lib_article'], $articleData['desc_courte'], $articleData['desc_longue']);
            $manager->persist($article);
        }
 */
        $manager->flush();
        $this->parcCacheService->findAllFromParcCache();
    }
}
