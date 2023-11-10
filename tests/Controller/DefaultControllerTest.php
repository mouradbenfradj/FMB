<?php

namespace App\Tests\Controller;

use App\Entity\Asc\Conteneur\Corde;
use App\Entity\Asc\Parc;
use App\Repository\Asc\Conteneur\CordeRepository;
use App\Repository\Asc\ParcRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class DefaultControllerTest extends WebTestCase
{

    private KernelBrowser $client;
    private string $path = '/';
    private string $selecteurParc = '#wrapper > div.content-page > div > div > div:nth-child(2) > div:nth-child(1) > div > ';
    private string $selecteurFiliere = '#wrapper > div.content-page > div > div > div:nth-child(2) > div:nth-child(2) > div > ';
    private string $selecteurCorde = '#wrapper > div.content-page > div > div > div:nth-child(3) > div:nth-child(';
    private string $selecteurLanterneText = '/';
    private string $selecteurpocheText = '/';
    private CordeRepository $cordeRepository;
    private ParcRepository $parcRepository;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->cordeRepository = (static::getContainer()->get('doctrine'))->getRepository(Corde::class);
        $this->parcRepository = (static::getContainer()->get('doctrine'))->getRepository(Parc::class);
    }

    public function testEmptyDbindex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($this->selecteurParc . 'p', 'Total Parc');
        $this->assertSelectorTextContains($this->selecteurParc . 'div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurFiliere . 'p', 'Total Filiere');
        $this->assertSelectorTextContains($this->selecteurFiliere . 'div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '1) > div > p', 'TotalCordes');
        $this->assertSelectorTextContains($this->selecteurCorde . '1) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '2) > div > p', 'Total Cordesà l\'eau');
        $this->assertSelectorTextContains($this->selecteurCorde . '2) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '3) > div > p', 'Cordes Huîtresà l\'eau');
        $this->assertSelectorTextContains($this->selecteurCorde . '3) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '4) > div > p', 'Cordes Moulesà l\'eau');
        $this->assertSelectorTextContains($this->selecteurCorde . '4) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '5) > div > p', 'Cordesvides');
        $this->assertSelectorTextContains($this->selecteurCorde . '5) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '6) > div > p', 'CordesPréparées');
        $this->assertSelectorTextContains($this->selecteurCorde . '6) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '7) > div > p', 'Cordes HuîtresPréparées');
        $this->assertSelectorTextContains($this->selecteurCorde . '7) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '8) > div > p', 'Cordes MoulesPréparées');
        $this->assertSelectorTextContains($this->selecteurCorde . '8) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '9) > div > p', 'Cordes AssembléesPréparées');
        $this->assertSelectorTextContains($this->selecteurCorde . '9) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '10) > div > p', 'Cordes Assembléesà l\'eau');
        $this->assertSelectorTextContains($this->selecteurCorde . '10) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '11) > div > p', 'ChaussettesCordes à l\'eau');
        $this->assertSelectorTextContains($this->selecteurCorde . '11) > div > div > div:nth-child(2) > div > h3 > span', '0');
    }
    public function testindex(): void
    {
        $crawler = $this->client->request('GET', $this->path);
        $parc = new Parc();
        $parc->setAbrevParc('12');
        $parc->setLibParc('12');
        $this->parcRepository->add($parc, true);
        $corde = new Corde();
        $corde->setNomCorde('corde');
        $corde->setParc($parc);
        $corde->setQuantiter(0);
        $this->cordeRepository->add($corde, true);
        self::assertSame(1, count($this->parcRepository->findAll()));
        self::assertSame(1, count($this->cordeRepository->findAll()));

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($this->selecteurParc . 'p', 'Total Parc');
        $this->assertSelectorTextContains($this->selecteurParc . 'div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurFiliere . 'p', 'Total Filiere');
        $this->assertSelectorTextContains($this->selecteurFiliere . 'div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '1) > div > p', 'TotalCordes');
        $this->assertSelectorTextContains($this->selecteurCorde . '1) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '2) > div > p', 'Total Cordesà l\'eau');
        $this->assertSelectorTextContains($this->selecteurCorde . '2) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '3) > div > p', 'Cordes Huîtresà l\'eau');
        $this->assertSelectorTextContains($this->selecteurCorde . '3) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '4) > div > p', 'Cordes Moulesà l\'eau');
        $this->assertSelectorTextContains($this->selecteurCorde . '4) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '5) > div > p', 'Cordesvides');
        $this->assertSelectorTextContains($this->selecteurCorde . '5) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '6) > div > p', 'CordesPréparées');
        $this->assertSelectorTextContains($this->selecteurCorde . '6) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '7) > div > p', 'Cordes HuîtresPréparées');
        $this->assertSelectorTextContains($this->selecteurCorde . '7) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '8) > div > p', 'Cordes MoulesPréparées');
        $this->assertSelectorTextContains($this->selecteurCorde . '8) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '9) > div > p', 'Cordes AssembléesPréparées');
        $this->assertSelectorTextContains($this->selecteurCorde . '9) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '10) > div > p', 'Cordes Assembléesà l\'eau');
        $this->assertSelectorTextContains($this->selecteurCorde . '10) > div > div > div:nth-child(2) > div > h3 > span', '0');

        $this->assertSelectorTextContains($this->selecteurCorde . '11) > div > p', 'ChaussettesCordes à l\'eau');
        $this->assertSelectorTextContains($this->selecteurCorde . '11) > div > div > div:nth-child(2) > div > h3 > span', '0');
    }
}
