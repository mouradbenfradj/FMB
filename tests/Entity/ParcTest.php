<?php

namespace App\Tests\Entity;

use App\Entity\Asc\Parc;
use App\Entity\Asc\FiliereComposite\Filiere;
use App\Entity\Asc\Stock\Stock;
use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Conteneur\Lanterne;
use PHPUnit\Framework\TestCase;

class ParcTest extends TestCase
{

    public function testSettersAndGetters()
    {
        $parc = new Parc();

        $parc->setLibParc('Test Parc');
        $parc->setAbrevParc('TP');

        $this->assertSame('Test Parc', $parc->getLibParc());
        $this->assertSame('TP', $parc->getAbrevParc());
    }

    public function testFilieres()
    {
        $parc = new Parc();
        $filiere = new Filiere();

        $parc->addFiliere($filiere);

        $this->assertTrue($parc->getFilieres()->contains($filiere));
        $this->assertSame($parc, $filiere->getParc());

        $parc->removeFiliere($filiere);

        $this->assertFalse($parc->getFilieres()->contains($filiere));
        $this->assertNull($filiere->getParc());
    }

    public function testStocks()
    {
        $parc = new Parc();
        $stock = new Stock();

        $parc->addStock($stock);

        $this->assertTrue($parc->getStocks()->contains($stock));
        $this->assertSame($parc, $stock->getParc());

        $parc->removeStock($stock);

        $this->assertFalse($parc->getStocks()->contains($stock));
        $this->assertNull($stock->getParc());
    }

    public function testCordes()
    {
        $parc = new Parc();
        $corde = new Corde();

        $parc->addCorde($corde);

        $this->assertTrue($parc->getCordes()->contains($corde));
        $this->assertSame($parc, $corde->getParc());

        $parc->removeCorde($corde);

        $this->assertFalse($parc->getCordes()->contains($corde));
        $this->assertNull($corde->getParc());
    }

    public function testLanternes()
    {
        $parc = new Parc();
        $lanterne = new Lanterne();

        $parc->addLanterne($lanterne);

        $this->assertTrue($parc->getLanternes()->contains($lanterne));
        $this->assertSame($parc, $lanterne->getParc());

        $parc->removeLanterne($lanterne);

        $this->assertFalse($parc->getLanternes()->contains($lanterne));
        $this->assertNull($lanterne->getParc());
    }
}
