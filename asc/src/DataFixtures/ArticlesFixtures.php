<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use App\Entity\FruitDeMer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Données statiques pour les articles - AJOUT DE PLUS D'ARTICLES
        $articlesData = [
            [
                'refArticle' => 'PLA-001',
                'libArticle' => 'Plateau de Huîtres N°3',
                'descCourte' => 'Plateau de 20 huîtres N°3',
                'descLongue' => 'Plateau premium de 20 huîtres creuses N°3, fraîchement cueillies',
                'fruitDeMer_ref' => 'fruitdemer_1'
            ],
            [
                'refArticle' => 'BAR-001',
                'libArticle' => 'Barquette de Moules',
                'descCourte' => 'Barquette de 1kg de moules',
                'descLongue' => 'Barquette de 1kg de moules de bouchot, prêtes à cuisiner',
                'fruitDeMer_ref' => 'fruitdemer_2'
            ],
            [
                'refArticle' => 'PAN-001',
                'libArticle' => 'Panier Coquillages',
                'descCourte' => 'Panier mélange coquillages',
                'descLongue' => 'Panier assorti de coquillages frais : bulots, praires, palourdes',
                'fruitDeMer_ref' => 'fruitdemer_3'
            ],
            // AJOUT DE NOUVEAUX ARTICLES
            [
                'refArticle' => 'PLA-002',
                'libArticle' => 'Plateau de Huîtres N°2',
                'descCourte' => 'Plateau de 12 huîtres N°2',
                'descLongue' => 'Plateau de 12 huîtres creuses N°2, de taille supérieure',
                'fruitDeMer_ref' => 'fruitdemer_1'
            ],
            [
                'refArticle' => 'BAR-002',
                'libArticle' => 'Barquette de Coquilles St Jacques',
                'descCourte' => 'Barquette de 500g de coquilles',
                'descLongue' => 'Barquette de 500g de coquilles Saint-Jacques fraîches',
                'fruitDeMer_ref' => 'fruitdemer_3'
            ],
            [
                'refArticle' => 'SAC-001',
                'libArticle' => 'Sac de Bulots',
                'descCourte' => 'Sac de 2kg de bulots',
                'descLongue' => 'Sac de 2kg de bulots cuits et prêts à déguster',
                'fruitDeMer_ref' => 'fruitdemer_4'
            ],
            [
                'refArticle' => 'CAI-001',
                'libArticle' => 'Caisse de Crevettes',
                'descCourte' => 'Caisse de 5kg de crevettes',
                'descLongue' => 'Caisse de 5kg de crevettes grises fraîches',
                'fruitDeMer_ref' => 'fruitdemer_5'
            ],
        ];

        foreach ($articlesData as $i => $data) {
            $article = new Articles();

            $article->setRefArticle($data['refArticle']);
            $article->setLibArticle($data['libArticle']);
            $article->setDescCourte($data['descCourte']);
            $article->setDescLongue($data['descLongue']);

            // Association avec FruitDeMer
            /** @var FruitDeMer $fruitDeMer */
            $fruitDeMer = $this->getReference($data['fruitDeMer_ref'], FruitDeMer::class);
            $article->setFruitDeMer($fruitDeMer);

            $manager->persist($article);
            $this->addReference("article_" . ($i + 1), $article);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            FruitDeMerFixtures::class,
        ];
    }
}
