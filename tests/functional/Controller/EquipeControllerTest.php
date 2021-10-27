<?php

namespace Tests\Functional\Controller;


use App\Entity\Equipe;
use App\DataFixtures\EquipeFixtures;
use App\DataFixtures\SaisonFixtures;
use Symfony\Component\HttpFoundation\Response;
use App\DataFixtures\EquipeSaisonJoueurFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class EquipeControllerTest extends WebTestCase
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
    public function testEquipePageIsUp(): void
    {
        /**
         * @var mixed $client
         */
        $client =  $this->testClient;
        $client->request('GET', '/les-equipes');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    // TEST SI LE H1 CORRESPOND BIEN A LA PAGE HOME
    public function testH1EquipePage(): void
    {
        /**
         * @var mixed $client
         */
        $client =  $this->testClient;

        $client->request('GET', '/les-equipes');
        $this->assertSelectorTextContains('h1', 'Liste des équipes');
    }


    public function testUneEquipePageIsUp(): void
    {

        /**
         * @var mixed $client
         */
        $client =  $this->testClient;

        /**
         * @var \Tests\Functional\Controller\UrlGeneratorInterface $urlGenerator
         */
        $urlGenerator =  $client->getContainer()->get("router.default");

        $this->databaseTool->loadFixtures([
            SaisonFixtures::class,
            EquipeFixtures::class,
            EquipeSaisonJoueurFixtures::class
        ]);

        /**
         * @var \Tests\Functional\Controller\EntityManagerInterface $entityManager
         */
        $entityManager = $client->getContainer()->get("doctrine.orm.entity_manager");

        /**
         * @var \App\Entity\Equipe $equipe
         */
        $equipe = $entityManager->getRepository(Equipe::class)->findOneBy([]);

        $client->request('GET', $urlGenerator->generate("une_equipe", ["id" => $equipe->getId()]));
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
