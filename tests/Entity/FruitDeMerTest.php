<?php

namespace App\Tests\Entity;

use App\Entity\FruitDeMer;
use App\Entity\Articles;
use App\Entity\Corde;
use PHPUnit\Framework\TestCase;

class FruitDeMerTest extends TestCase
{
    public function testGetId()
    {
        $fruitDeMer = new FruitDeMer();
        $this->assertNull($fruitDeMer->getId());
    }

    public function testSetAndGetNom()
    {
        $fruitDeMer = new FruitDeMer();
        $fruitDeMer->setNom('Fruit de Mer Test');
        $this->assertEquals('Fruit de Mer Test', $fruitDeMer->getNom());
    }

    public function testAddAndRemoveArticle()
    {
        $fruitDeMer = new FruitDeMer();
        $article = new Articles();
        $fruitDeMer->addArticle($article);

        $this->assertCount(1, $fruitDeMer->getArticles());
        $this->assertTrue($fruitDeMer->getArticles()->contains($article));

        $fruitDeMer->removeArticle($article);
        $this->assertCount(0, $fruitDeMer->getArticles());
    }

    public function testAddAndRemoveCorde()
    {
        $fruitDeMer = new FruitDeMer();
        $corde = new Corde();
        $fruitDeMer->addCorde($corde);

        $this->assertCount(1, $fruitDeMer->getCordes());
        $this->assertTrue($fruitDeMer->getCordes()->contains($corde));

        $fruitDeMer->removeCorde($corde);
        $this->assertCount(0, $fruitDeMer->getCordes());
    }
}
