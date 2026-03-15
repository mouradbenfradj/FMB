<?php

namespace App\DataFixtures;

use App\Entity\Corde;
use App\Entity\Segment;
use App\Entity\StockCorde;
use App\Entity\StockArticleSn;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class StockCordeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Récupérer quelques segments pour avoir leurs emplacements
        $segments = [];
        for ($i = 0; $i < 10; $i++) {
            if ($this->hasReference("segment_$i", Segment::class)) {
                $segments[] = $this->getReference("segment_$i", Segment::class);
            }
        }

        // Données pour les stocks de cordes
        $stocksCordeData = [
            [
                'corde_ref' => 'corde_1',
                'stockArticleSn_ref' => 'stockarticlesn_1',
                'quantite' => 5,
                'longueur' => 25.50,
                'pret' => false,
                'datedecreation' => new \DateTime('2024-01-15'),
                'chaussement' => false
            ],
            [
                'corde_ref' => 'corde_2',
                'stockArticleSn_ref' => 'stockarticlesn_2',
                'quantite' => 3,
                'longueur' => 18.75,
                'pret' => false,
                'datedecreation' => new \DateTime('2024-02-10'),
                'chaussement' => true,
                'datechaussement' => null
            ],
            [
                'corde_ref' => 'corde_3',
                'stockArticleSn_ref' => 'stockarticlesn_3',
                'quantite' => 8,
                'longueur' => 28.25,
                'pret' => false,
                'datedecreation' => new \DateTime('2024-01-20'),
                'chaussement' => false
            ],
            [
                'corde_ref' => 'corde_1',
                'stockArticleSn_ref' => 'stockarticlesn_4',
                'quantite' => 6,
                'longueur' => 22.00,
                'pret' => false,
                'datedecreation' => new \DateTime('2024-03-01'),
                'chaussement' => true,
                'datechaussement' => null
            ],
            [
                'corde_ref' => 'corde_2',
                'stockArticleSn_ref' => 'stockarticlesn_5',
                'quantite' => 4,
                'longueur' => 20.00,
                'pret' => false,
                'datedecreation' => new \DateTime('2024-03-15'),
                'chaussement' => false
            ],
            [
                'corde_ref' => 'corde_3',
                'stockArticleSn_ref' => 'stockarticlesn_1',
                'quantite' => 7,
                'longueur' => 26.50,
                'pret' => false,
                'datedecreation' => new \DateTime('2024-04-01'),
                'chaussement' => true,
                'datechaussement' => null
            ],
            [
                'corde_ref' => 'corde_1',
                'stockArticleSn_ref' => 'stockarticlesn_2',
                'quantite' => 10,
                'longueur' => 30.00,
                'pret' => false,
                'datedecreation' => new \DateTime('2024-04-20'),
                'chaussement' => false
            ],
        ];

        $stockCordeIndex = 1;

        foreach ($stocksCordeData as $data) {
            // Sélectionner un segment aléatoire
            if (count($segments) > 0) {
                /** @var Segment $segment */
                $segment = $segments[array_rand($segments)];

                // Prendre le premier emplacement disponible de ce segment
                $emplacements = $segment->getEmplacements();
                if ($emplacements->count() > 0) {
                    $emplacement = $emplacements->first();

                    $stockCorde = new StockCorde();

                    $stockCorde->setquantite($data['quantite']);
                    $stockCorde->setLongeur($data['longueur']);
                    $stockCorde->setPret($data['pret']);
                    $stockCorde->setDatedecreation($data['datedecreation']);
                    $stockCorde->setChaussement($data['chaussement']);

                    // Associations avec les entités liées
                    /** @var Corde $corde */
                    $corde = $this->getReference($data['corde_ref'], Corde::class);
                    $stockCorde->setCorde($corde);

                    /** @var StockArticleSn $stockArticleSn */
                    $stockArticleSn = $this->getReference($data['stockArticleSn_ref'], StockArticleSn::class);
                    $stockCorde->setStockArticleSn($stockArticleSn);

                    // Association avec l'emplacement du segment
                    $stockCorde->setDateDeMiseAEau($data['datedecreation']);
                    $stockCorde->setEmplacement($emplacement);

                    // Dates optionnelles
                    if (isset($data['datechaussement'])) {
                        $stockCorde->setDatechaussement($data['datechaussement']);
                    }

                    $manager->persist($stockCorde);
                    $this->addReference("stockcorde_" . $stockCordeIndex, $stockCorde);
                    $stockCordeIndex++;
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SegmentFixtures::class,
            CordeFixtures::class,
            StockArticleSnFixtures::class,
        ];
    }
}
