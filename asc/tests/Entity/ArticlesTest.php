<?php

namespace App\Tests\Entity;

use App\Entity\Articles;
use App\Entity\FruitDeMer;
use App\Entity\StockArticle;
use PHPUnit\Framework\TestCase;

class ArticlesTest extends TestCase
{
    public function testInstantiation(): void
    {
        $article = new Articles();
        $this->assertInstanceOf(Articles::class, $article);
        $this->assertNull($article->getId());
        $this->assertNull($article->getRefArticle());
        $this->assertNull($article->getLibArticle());
        $this->assertNull($article->getDescCourte());
        $this->assertNull($article->getDescLongue());
        $this->assertNull($article->getFruitDeMer());
        $this->assertEmpty($article->getStockArticles());
    }

    public function testSettersAndGetters(): void
    {
        $article = new Articles();

        $article->setRefArticle('REF001');
        $this->assertEquals('REF001', $article->getRefArticle());

        $article->setLibArticle('Test Article');
        $this->assertEquals('Test Article', $article->getLibArticle());

        $article->setDescCourte('Short description');
        $this->assertEquals('Short description', $article->getDescCourte());

        $article->setDescLongue('Long description');
        $this->assertEquals('Long description', $article->getDescLongue());

        $fruitDeMer = new FruitDeMer();
        $article->setFruitDeMer($fruitDeMer);
        $this->assertSame($fruitDeMer, $article->getFruitDeMer());
    }

    public function testToString(): void
    {
        $article = new Articles();
        $article->setLibArticle('Test Article');

        $fruitDeMer = new FruitDeMer();
        $fruitDeMer->setNom('Test Fruit');
        $article->setFruitDeMer($fruitDeMer);

        $this->assertEquals('Test Article Test Fruit', (string) $article);
    }

    public function testStockArticlesRelationship(): void
    {
        $article = new Articles();
        $stockArticle = new StockArticle();

        $this->assertEmpty($article->getStockArticles());

        $article->addStockArticle($stockArticle);
        $this->assertCount(1, $article->getStockArticles());
        $this->assertSame($article, $stockArticle->getArticles());

        $article->removeStockArticle($stockArticle);
        $this->assertEmpty($article->getStockArticles());
        $this->assertNull($stockArticle->getArticles());
    }

    public function testAddStockArticleDoesNotDuplicate(): void
    {
        $article = new Articles();
        $stockArticle = new StockArticle();

        $article->addStockArticle($stockArticle);
        $article->addStockArticle($stockArticle);

        $this->assertCount(1, $article->getStockArticles());
    }
}
