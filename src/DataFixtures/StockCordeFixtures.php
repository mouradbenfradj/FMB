<?php

namespace App\DataFixtures;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Stock\StockArticle;
use App\Entity\Asc\Stock\StockCorde;
use App\Service\Cache\ParcCacheService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class StockCordeFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
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
        return ['default', 'stockCordes'];
    }

    public function getDependencies()
    {
        return array(
            StockArticleSnFixtures::class,
            CordeFixtures::class,
            EmplacementOysterproToAscFixtures::class,
        );
    }
    public function load(ObjectManager $manager): void
    {

        $stocksCordes = $this->oysterProManager->getConnection()->fetchAllAssociative('SELECT * FROM stocks_cordes');
        foreach ($stocksCordes as $stockCordesDb) {
            /* 
 [
  "id" => "1"
  "corde_id" => "2"
  "emplacement_id" => null
  "ref_stock_article" => "58273b6cd07e9"
  "numero_serie" => "LOT NH34 BLEU"
  "doc_line" => "57f8c931b7cdd"
  "quantiter" => "90"
  "pret" => "1"
  "dateDeCreation" => "2016-09-09"
  "dateDeRetirement" => "2017-03-30"
  "dateDeRetraitTransfert" => "2017-03-20"
  "dateDeMAETransfert" => "2017-03-20"
  "date_de_mise_a_eau" => null
  "chaussement" => "0"
  "processus_id" => "2"
  "dateAssemblage" => null
  "dateChaussement" => null
]
*/
            $corde = $this->getReference('corde' . $stockCordesDb['corde_id']);
            $stockArticleSn = $this->getReference('stockArticleSn' . $stockCordesDb['ref_stock_article'] . $stockCordesDb['numero_serie']);
            if ($stockCordesDb['emplacement_id'])
                $emplacement = $this->getReference('emplacement' . $stockCordesDb['emplacement_id']);

            $stockCorde = new StockCorde();
            $stockCorde->setQuantiter($stockCordesDb['quantiter']);
            $stockCorde->setPret($stockCordesDb['pret']);
            $stockCorde->setChaussement($stockCordesDb['chaussement']);
            $stockCorde->setPoid(30);
            $stockCorde->setCorde($corde);
            $stockCorde->setStockArticleSn($stockArticleSn);
            $stockCorde->setDatedecreation(new \DateTime($stockCordesDb['dateDeCreation']));
            $stockCorde->setDatederetirement(new \DateTime($stockCordesDb['dateDeRetirement']));
            $stockCorde->setDatederetraittransfert(new \DateTime($stockCordesDb['dateDeRetraitTransfert']));
            $stockCorde->setDatedemaetransfert(new \DateTime($stockCordesDb['dateDeMAETransfert']));
            $stockCorde->setDateDeMiseAEaudate(new \DateTime($stockCordesDb['date_de_mise_a_eau']));
            $stockCorde->setDateassemblage(new \DateTime($stockCordesDb['dateAssemblage']));
            $stockCorde->setDatechaussement(new \DateTime($stockCordesDb['dateChaussement']));
            if ($stockCordesDb['emplacement_id'])
                $stockCorde->setEmplacement($emplacement);
            $manager->persist($stockCorde);
        }
        $manager->flush();
    }
}
