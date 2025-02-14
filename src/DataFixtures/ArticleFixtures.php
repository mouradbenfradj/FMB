<?php

namespace App\DataFixtures;

use App\Entity\Asc\Articles;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        return ['default', 'article'];
    }

    public function getDependencies()
    {
        return array(
            FruitDeMerFixtures::class,
        );
    }
    public function load(ObjectManager $manager): void
    {
        $oysterProArticles = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM articles ');
        $huitre = $this->getReference('huitre');
        $moule = $this->getReference('moule');
        foreach ($oysterProArticles as $articleData) {
            /*
[
  "ref_article" => "57f7b1e198786"
  "id_modele_spe" => null
  "id_valo" => null
  "ref_oem" => null
  "ref_interne" => null
  "lib_article" => "NAISSAIN HUITRES"
  "lib_ticket" => "NAISS H"
  "desc_courte" => "NH"
  "desc_longue" => "YGVYG"
  "ref_art_categ" => "5a0edf052aa4c"
  "modele" => "TVYTV"
  "ref_constructeur" => null
  "prix_public_ht" => null
  "prix_achat_ht" => null
  "paa_ht" => null
  "paa_last_maj" => "2011-01-01 00:00:00"
  "id_tva" => null
  "promo" => "-9"
  "valo_indice" => "1"
  "lot" => "0"
  "composant" => "0"
  "variante" => "0"
  "gestion_sn" => "0"
  "date_debut_dispo" => "2011-01-01 00:00:00"
  "date_fin_dispo" => "2011-01-01 00:00:00"
  "dispo" => "0"
  "date_creation" => "2011-01-01 00:00:00"
  "date_modification" => "2011-01-01 00:00:00"
  "numero_compte_achat" => null
  "numero_compte_vente" => null
  "is_achetable" => "0"
  "is_vendable" => "0"
]
   */
            $article = new Articles();
            switch ($articleData['ref_art_categ']) {
                case '5a0edf052aa4c':
                    $article->initArticle($huitre, $articleData['ref_article'], $articleData['lib_article'], $articleData['desc_courte'], $articleData['desc_longue']);
                    $this->addReference('article' . $articleData['ref_article'], $article);
                    $manager->persist($article);
                    break;
                case '5a0edf05430f2':
                    $article->initArticle($moule, $articleData['ref_article'], $articleData['lib_article'], $articleData['desc_courte'], $articleData['desc_longue']);
                    $this->addReference('article' . $articleData['ref_article'], $article);
                    $manager->persist($article);
                    break;
            }
        }

        $manager->flush();
    }
}
