<?php

namespace App\Tests\Unit\Entity\Asc;

use App\Entity\Asc\Parc;
use App\Entity\Asc\FiliereComposite\Filiere;
use App\Entity\Asc\Stock\Stock;
use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Conteneur\Lanterne;
use PHPUnit\Framework\TestCase;

class ParcTest extends TestCase
{
    public function testGetId()
    {
        $parc = new Parc();
        $this->assertNull($parc->getId());
    }

    public function testSetAndGetLibParc()
    {
        $parc = new Parc();
        $parc->setLibParc('Parc Test');
        $this->assertEquals('Parc Test', $parc->getLibParc());
    }

    public function testSetAndGetAbrevParc()
    {
        $parc = new Parc();
        $parc->setAbrevParc('PT');
        $this->assertEquals('PT', $parc->getAbrevParc());
    }

    public function testAddAndRemoveFiliere()
    {
        $parc = new Parc();
        $filiere = new Filiere();
        $parc->addFiliere($filiere);

        $this->assertCount(1, $parc->getFilieres());
        $this->assertTrue($parc->getFilieres()->contains($filiere));

        $parc->removeFiliere($filiere);
        $this->assertCount(0, $parc->getFilieres());
    }

    public function testAddAndRemoveStock()
    {
        $parc = new Parc();
        $stock = new Stock();
        $parc->addStock($stock);

        $this->assertCount(1, $parc->getStocks());
        $this->assertTrue($parc->getStocks()->contains($stock));

        $parc->removeStock($stock);
        $this->assertCount(0, $parc->getStocks());
    }

    public function testAddAndRemoveCorde()
    {
        $parc = new Parc();
        $corde = new Corde();
        $parc->addCorde($corde);

        $this->assertCount(1, $parc->getCordes());
        $this->assertTrue($parc->getCordes()->contains($corde));

        $parc->removeCorde($corde);
        $this->assertCount(0, $parc->getCordes());
    }

    public function testAddAndRemoveLanterne()
    {
        $parc = new Parc();
        $lanterne = new Lanterne();
        $parc->addLanterne($lanterne);

        $this->assertCount(1, $parc->getLanternes());
        $this->assertTrue($parc->getLanternes()->contains($lanterne));

        $parc->removeLanterne($lanterne);
        $this->assertCount(0, $parc->getLanternes());
    }

    public function testGetTotaleFilieres()
    {
        $parc = new Parc();
        $filiere1 = new Filiere();
        $filiere2 = new Filiere();
        $parc->addFiliere($filiere1);
        $parc->addFiliere($filiere2);

        $this->assertEquals(2, $parc->getTotaleFilieres());
    }

    public function testGetTotaleCordes()
    {
        $parc = new Parc();
        $corde1 = new Corde();
        $corde1->setQuantiter(5);
        $corde2 = new Corde();
        $corde2->setQuantiter(10);
        $parc->addCorde($corde1);
        $parc->addCorde($corde2);

        $this->assertEquals(15, $parc->getTotaleCordes());
    }
}
