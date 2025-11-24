<?php

namespace App\DataFixtures;

use App\Entity\StockArticleSn;
use App\Entity\StockArticle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StockArticleSnFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $stockArticleSnData = [
            [
                'stockArticle_ref' => 'stockarticle_1',
                'snQte' => 100.0,
                'numeroSerie' => 'SN-001-2024'
            ],
            [
                'stockArticle_ref' => 'stockarticle_2',
                'snQte' => 50.0,
                'numeroSerie' => 'SN-002-2024'
            ],
            [
                'stockArticle_ref' => 'stockarticle_3',
                'snQte' => 75.0,
                'numeroSerie' => 'SN-003-2024'
            ],
            [
                'stockArticle_ref' => 'stockarticle_4',
                'snQte' => 30.0,
                'numeroSerie' => 'SN-004-2024'
            ],
            [
                'stockArticle_ref' => 'stockarticle_5',
                'snQte' => 60.0,
                'numeroSerie' => 'SN-005-2024'
            ],
        ];

        foreach ($stockArticleSnData as $i => $data) {
            $stockArticleSn = new StockArticleSn();
            $stockArticleSn->setSnQte($data['snQte']);
            $stockArticleSn->setNumeroSerie($data['numeroSerie']);

            // Association avec StockArticle
            /** @var StockArticle $stockArticle */
            $stockArticle = $this->getReference($data['stockArticle_ref'], StockArticle::class);
            $stockArticleSn->setStockArticle($stockArticle);

            $manager->persist($stockArticleSn);
            $this->addReference('stockarticlesn_' . ($i + 1), $stockArticleSn);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            StockArticleFixtures::class,
        ];
    }
}
