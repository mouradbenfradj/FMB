<?php

namespace App\DataFixtures;

use App\Entity\Emplacement;
use App\Entity\Lanterne;
use App\Entity\StockArticleSn;
use App\Entity\StockLanterne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StockLanterneFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $stockLanternesData = [
            [
                'lanterne_ref' => 'lanterne_1',
                'stockArticleSn_ref' => 'stockarticlesn_1',
                'pret' => true,
                'datedecreation' => new \DateTime('2023-01-01'),
                'datederetirement' => null,
                'datederetraittransfert' => null,
                'datedemaetransfert' => null,
                'dateDeMiseAEau' => new \DateTime('2023-01-15'),
            ],
            [
                'lanterne_ref' => 'lanterne_2',
                'stockArticleSn_ref' => 'stockarticlesn_2',
                'pret' => false,
                'datedecreation' => new \DateTime('2023-02-01'),
                'datederetirement' => new \DateTime('2023-06-01'),
                'datederetraittransfert' => new \DateTime('2023-05-30'),
                'datedemaetransfert' => new \DateTime('2023-05-25'),
                'dateDeMiseAEau' => new \DateTime('2023-02-10'),
            ],
            [
                'lanterne_ref' => 'lanterne_3',
                'stockArticleSn_ref' => 'stockarticlesn_3',
                'pret' => true,
                'datedecreation' => new \DateTime('2023-03-01'),
                'datederetirement' => null,
                'datederetraittransfert' => null,
                'datedemaetransfert' => null,
                'dateDeMiseAEau' => new \DateTime('2023-03-15'),
            ],
        ];

        foreach ($stockLanternesData as $i => $data) {
            $stockLanterne = new StockLanterne();

            /** @var Lanterne $lanterne */
            $lanterne = $this->getReference($data['lanterne_ref'], Lanterne::class);
            $stockLanterne->setLanterne($lanterne);

            /** @var StockArticleSn $stockArticleSn */
            $stockArticleSn = $this->getReference($data['stockArticleSn_ref'], StockArticleSn::class);
            $stockLanterne->setStockArticleSn($stockArticleSn);

            // Emplacement is nullable, set to null for now
            $stockLanterne->setEmplacement(null);

            $stockLanterne->setPret($data['pret']);
            $stockLanterne->setDatedecreation($data['datedecreation']);
            $stockLanterne->setDatederetirement($data['datederetirement']);
            $stockLanterne->setDatederetraittransfert($data['datederetraittransfert']);
            $stockLanterne->setDatedemaetransfert($data['datedemaetransfert']);
            $stockLanterne->setDateDeMiseAEau($data['dateDeMiseAEau']);

            $manager->persist($stockLanterne);
            $this->addReference('stocklanterne_' . ($i + 1), $stockLanterne);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LanterneFixtures::class,
            StockArticleSnFixtures::class,
            SegmentFixtures::class, // Pour les emplacements créés automatiquement
        ];
    }
}
