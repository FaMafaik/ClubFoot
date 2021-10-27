<?php

namespace Tests\Functional\Controller;

use App\Entity\Saison;
use App\DataFixtures\SaisonFixtures;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class SaisonControllerTest extends WebTestCase
{

    /**
     * @var mixed $databaseTool
     */
    protected $databaseTool;

    /**
     * @var mixed $testClient
     */
    private $testClient = null;

    public function setUp(): void
    {
        $this->testClient = static::createClient();
        $this->databaseTool = $this->testClient->getContainer()->get(DatabaseToolCollection::class)->get();
    }

    //TEST SI IL N'Y A PAS D'ERREURS SUR LA PAGE HOME
    public function testSaisonPageIsUp(): void
    {
        /**
         * @var mixed $client
         */
        $client =  $this->testClient;
        $client->request('GET', '/saisons');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testUneSaisonPageIsUp(): void
    {
        /**
         * @var mixed $client
         */
        $client =  $this->testClient;

        // Pour etre  sûr que le lien marche

        /**
         * @var \Tests\Functional\Controller\UrlGeneratorInterface $urlGenerator
         */
        $urlGenerator =  $client->getContainer()->get("router.default");

        $this->databaseTool->loadFixtures([
            SaisonFixtures::class,
        ]);

        /**
         * @var \Tests\Functional\Controller\EntityManagerInterface $entityManager
         */
        $entityManager = $client->getContainer()->get("doctrine.orm.entity_manager");

        /**
         * @var \App\Entity\Saison $saison
         */
        $saison = $entityManager->getRepository(Saison::class)->findOneBy([]);

        $client->request('GET', $urlGenerator->generate("une_saison", ["id" => $saison->getId()]));
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
