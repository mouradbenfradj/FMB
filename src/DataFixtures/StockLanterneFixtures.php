<?php

namespace App\DataFixtures;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Stock\StockArticle;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class StockLanterneFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        return ['default'];
    }

    public function getDependencies()
    {
        return array(
            ArticleFixtures::class,
        );
    }
    public function load(ObjectManager $manager): void
    {

        $stocksArticlesOysterPro = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM stocks_articles');
        foreach ($stocksArticlesOysterPro as $stocksArticleOysterPro) {

            dd($stocksArticleOysterPro);
            $flotteur = $this->getReference('flotteur' . substr($flotteurOysterPro[0]['nomFlotteur'], 0, 1));

            $stockArticle = new StockArticle();
        }
        $manager->flush();
    }
}
