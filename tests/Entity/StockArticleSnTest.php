<?php

namespace App\Tests\Entity;

use App\Entity\StockArticleSn;
use PHPUnit\Framework\TestCase;

class StockArticleSnTest extends TestCase
{
    public function testGetId()
    {
        $stockArticleSn = new StockArticleSn();
        $this->assertNull($stockArticleSn->getId());
    }

    public function testSetAndGetSn()
    {
        $stockArticleSn = new StockArticleSn();
        $stockArticleSn->setSn('SN123');
        $this->assertEquals('SN123', $stockArticleSn->getSn());
    }
}
