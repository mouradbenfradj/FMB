<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\ParcRepository;
use App\Repository\EmplacementRepository;

class FormSubmissionTest extends WebTestCase
{
    private function login($client)
    {
        $crawler = $client->request('GET', '/admin/login');
        if ($client->getResponse()->getStatusCode() !== 200) {
            echo $client->getResponse()->getContent();
            die();
        }
        // Sonata login form usually has these fields
        $form = $crawler->filter('form')->form([
            '_username' => 'mourad',
            '_password' => 'mourad',
        ]);
        $client->submit($form);
        return $client;
    }

    public function testMaeCordePageLoads(): void
    {
        $client = static::createClient();
        $this->login($client);

        $parcRepository = static::getContainer()->get(ParcRepository::class);
        $parc = $parcRepository->findOneBy([]);

        if (!$parc) {
            $this->markTestSkipped('No Parc found to test MAE page.');
        }

        $client->request('GET', '/mae/corde/' . $parc->getId());
        if ($client->getResponse()->getStatusCode() === 302) {
            echo "Redirected to: " . $client->getResponse()->headers->get('Location') . "\n";
            // Follow redirect to see why
            $crawler = $client->followRedirect();
            echo "Redirect content: " . $client->getResponse()->getContent() . "\n";
        }
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form[name="mae_corde"]');
    }

    public function testFullMaeCordeFlow(): void
    {
        $client = static::createClient();
        $this->login($client);

        $container = static::getContainer();
        $em = $container->get('doctrine.orm.entity_manager');

        $parc = $container->get(ParcRepository::class)->findOneBy([]);
        $stock = $parc->getStocks()->first();

        // Find a StockCorde and make it available for MAE
        $stockCorde = $container->get(\App\Repository\StockCordeRepository::class)->findOneBy([]);
        $stockCorde->setDateDeMiseAEau(null);
        $stockCorde->setEmplacement(null);
        $stockCorde->setPret(false);
        $em->flush();

        $corde = $stockCorde->getCorde();
        $fruitDeMer = $container->get(\App\Repository\FruitDeMerRepository::class)->findOneBy(['nom' => 'huitre']);
        $lot = $stockCorde->getStockArticleSn();
        $article = $lot->getStockArticle();

        $phase = $container->get(\App\Repository\PhaseRepository::class)->findOneBy([]);
        $processus = $phase->getProcessuses()->first();

        // Find an empty emplacement
        $emplacement = $container->get(EmplacementRepository::class)->createQueryBuilder('e')
            ->leftJoin('App\Entity\StockMateriel', 'sm', 'WITH', 'sm.emplacement = e')
            ->where('sm.id IS NULL')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if (!$emplacement) {
            // If all full, empty one
            $emplacement = $container->get(EmplacementRepository::class)->findOneBy([]);
            $emplacement->setStockMateriel(null);
            $em->flush();
        }

        $client->request('GET', '/'); // Ensure session is started

        // Manually set session data to bypass dynamic form issues in test
        $session = $client->getRequest()->getSession();
        $session->set('parc', $parc);
        $session->set('form_data', [
            'stocks' => $stock->getId(),
            'corde' => $corde->getId(),
            'datedeMAE' => '2025-05-11',
            'fruitDeMer' => $fruitDeMer->getId(),
            'article' => $article->getId(),
            'lot' => $lot->getId(),
            'phase' => $phase->getId(),
            'processus' => $processus->getId(),
            'densiter' => 100,
            'disponibiliter' => 10,
        ]);
        $session->set('emplacements', [$emplacement->getId()]);
        $session->save();

        // 1. Visit validation page
        $client->request('GET', '/mae/corde_validation');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Validation de la Mise à l\'Eau');

        // 2. Confirm validation
        $client->request('POST', '/mae/corde_validation', ['confirm' => 1]);
        $this->assertResponseRedirects('/mae/confirmation');

        // 3. Verify persistence
        $em = $container->get('doctrine.orm.entity_manager');
        $em->clear();
        $updatedEmplacement = $container->get(EmplacementRepository::class)->find($emplacement->getId());
        $this->assertNotNull($updatedEmplacement->getStockMateriel());
        $this->assertEquals(100, $updatedEmplacement->getStockMateriel()->getQuantite());
    }

    public function testFullTransfertFlow(): void
    {
        $client = static::createClient();
        $this->login($client);

        $container = static::getContainer();
        $parc = $container->get(ParcRepository::class)->findOneBy([]);

        // Find an emplacement with material using a join
        $em = $container->get('doctrine.orm.entity_manager');

        // Ensure we have something to transfer (fixtures should have provided it)
        $sourceEmp = $em->getRepository(\App\Entity\Emplacement::class)->createQueryBuilder('e')
            ->join('App\Entity\StockMateriel', 'sm', 'WITH', 'sm.emplacement = e')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        $destEmp = $em->getRepository(\App\Entity\Emplacement::class)->createQueryBuilder('e')
            ->leftJoin('App\Entity\StockMateriel', 'sm', 'WITH', 'sm.emplacement = e')
            ->where('sm.id IS NULL')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if (!$sourceEmp || !$destEmp) {
            $this->markTestSkipped('Need both source and destination emplacements.');
        }

        $client->request('GET', '/'); // Ensure session is started

        // Manually set session data
        $session = $client->getRequest()->getSession();
        $session->set('sources', [$sourceEmp->getId()]);
        $session->set('destinations', [$destEmp->getId()]);
        $session->save();

        // 1. Confirm transfert
        $client->request('POST', '/retrait-transfert/' . $parc->getId() . '/confirmation', ['confirm' => 1]);
        $this->assertResponseRedirects('/retrait-transfert/' . $parc->getId() . '/success');

        // 2. Verify
        $em->clear();
        $updatedDest = $em->getRepository(\App\Entity\Emplacement::class)->find($destEmp->getId());
        $updatedSource = $em->getRepository(\App\Entity\Emplacement::class)->find($sourceEmp->getId());

        $this->assertNotNull($updatedDest->getStockMateriel());
        $this->assertNull($updatedSource->getStockMateriel());
    }
}
