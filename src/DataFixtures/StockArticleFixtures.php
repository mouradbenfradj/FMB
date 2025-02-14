<?php

namespace App\DataFixtures;

use App\Entity\Asc\Stock\StockArticle;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class StockArticleFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        return ['default', 'stocksArticleOysterPro'];
    }

    public function getDependencies()
    {
        return array(
            ArticleFixtures::class,
            StockOysterproToAscFixtures::class,
        );
    }
    public function load(ObjectManager $manager): void
    {

        $stocksArticlesOysterPro = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM stocks_articles');
        foreach ($stocksArticlesOysterPro as $stocksArticleOysterPro) {
            /* 
[
  "ref_stock_article" => "57f7c01c81859"
  "ref_article" => "57f7b1e198786"
  "id_stock" => "1"
  "qte" => "12550"
]*/
            switch ($stocksArticleOysterPro['ref_article']) {
                case '5a0edf4867a42':
                case '5a0edf4c28760':
                case '5a0edf5712e28':
                case '5a0edf5ad8efa':
                case '5a0edf5ec5f2b':
                case '5a0edf627a8f6':
                case '5a0edf6643ece':
                case '5a0edf69f2c82':
                case '5a0edf6dacc3f':
                    break;
                default:

                    $stock = $this->getReference('stock' . $stocksArticleOysterPro['id_stock']);
                    $article = $this->getReference('article' . $stocksArticleOysterPro['ref_article']);

                    $stockArticle = new StockArticle();
                    $stockArticle->setQuantiter($stocksArticleOysterPro['qte']);
                    $stockArticle->setStock($stock);
                    $stockArticle->setArticle($article);
                    $this->ascManager->persist($stockArticle);
                    $this->addReference('stockArticle' . $stocksArticleOysterPro['ref_stock_article'], $stockArticle);
                    break;
            }
        }
        $manager->flush();
    }
}
