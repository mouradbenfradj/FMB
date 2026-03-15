<?php

namespace App\DataFixtures;

use App\Entity\StockArticle;
use App\Entity\Stock;
use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StockArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $stockArticleData = [
            [
                'stock_ref' => 'stock_1', // Stock Parc FMB
                'article_ref' => 'article_1',
                'quantite' => 500
            ],
            [
                'stock_ref' => 'stock_1', // Stock Parc FMB
                'article_ref' => 'article_2',
                'quantite' => 300
            ],
            [
                'stock_ref' => 'stock_2', // Stock Parc MARINOR
                'article_ref' => 'article_3',
                'quantite' => 200
            ],
            [
                'stock_ref' => 'stock_2', // Stock Parc MARINOR
                'article_ref' => 'article_4',
                'quantite' => 150
            ],
            [
                'stock_ref' => 'stock_3', // Stock FMB Station
                'article_ref' => 'article_5',
                'quantite' => 400
            ],
        ];

        foreach ($stockArticleData as $i => $data) {
            $stockArticle = new StockArticle();
            $stockArticle->setquantite($data['quantite']);

            // Association avec Stock
            /** @var Stock $stock */
            $stock = $this->getReference($data['stock_ref'], Stock::class);
            $stockArticle->setStock($stock);

            // Association avec Article
            /** @var Articles $article */
            $article = $this->getReference($data['article_ref'], Articles::class);
            $stockArticle->setArticles($article);

            $manager->persist($stockArticle);
            $this->addReference('stockarticle_' . ($i + 1), $stockArticle);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            StockFixtures::class,
            ArticlesFixtures::class,
        ];
    }
}
