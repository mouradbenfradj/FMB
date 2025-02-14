<?php

namespace App\DataFixtures;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Stock\StockArticle;
use App\Entity\Asc\Stock\StockArticleSn;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class StockArticleSnFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        return ['default', 'stocks_articles_sn'];
    }

    public function getDependencies()
    {
        return array(
            StockArticleFixtures::class,
        );
    }
    public function load(ObjectManager $manager): void
    {

        $stocksArticlesSnOysterPro = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM stocks_articles_sn');
        foreach ($stocksArticlesSnOysterPro as $stocksArticleSnOysterPro) {
            /* 
            [
            "numero_serie" => "DM2018"
            "ref_stock_article" => "59d3ad8ed645c"
            "sn_qte" => "299700"
            ]
            */
            $stockArticle = $this->getReference('stockArticle' . $stocksArticleSnOysterPro['ref_stock_article']);
            $stockArticleSn = new StockArticleSn();
            $stockArticleSn->setSnQte($stocksArticleSnOysterPro['sn_qte']);
            $stockArticleSn->setNumeroSerie($stocksArticleSnOysterPro['numero_serie']);
            $stockArticleSn->setStockArticle($stockArticle);
            $this->ascManager->persist($stockArticleSn);
            $this->addReference('stockArticleSn' . $stocksArticleSnOysterPro['ref_stock_article'] . $stocksArticleSnOysterPro['numero_serie'], $stockArticleSn);
        }
        $manager->flush();
    }
}
