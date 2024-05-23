<?php

namespace App\Tests\Service;

use App\Service\FiliereService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FiliereServiceTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        $filiereService = static::getContainer()->get(FiliereService::class);
    }
}
