<?php

namespace Tests\Functional\Controller;

use App\DataFixtures\EquipeFixtures;
use App\DataFixtures\MatchsFixtures;
use App\DataFixtures\NiveauFixtures;
use App\DataFixtures\SaisonFixtures;
use App\DataFixtures\JoueursFixtures;
use App\DataFixtures\PerformanceFixtures;
use App\DataFixtures\ParticipationFixtures;
use Symfony\Component\HttpFoundation\Response;
use App\DataFixtures\EquipeSaisonJoueurFixtures;
use App\Entity\Joueurs;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class JoueurControllerTest extends WebTestCase
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
    public function testJoueurPageIsUp(): void
    {
        /**
         * @var mixed $client
         */
        $client =  $this->testClient;

        $client->request('GET', '/les-joueurs');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    // TEST SI LE H1 CORRESPOND BIEN A LA PAGE JOUEUR
    public function testH1JoueurPage(): void
    {
        /**
         * @var mixed $client
         */
        $client =  $this->testClient;

        $client->request('GET', '/les-joueurs');
        $this->assertSelectorTextContains('h1', 'Liste des joueurs');
    }

    public function testUnJoueurPageIsUp(): void
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
            NiveauFixtures::class,
            EquipeFixtures::class,
            SaisonFixtures::class,
            JoueursFixtures::class,
            EquipeSaisonJoueurFixtures::class,
            MatchsFixtures::class,
            ParticipationFixtures::class,
            PerformanceFixtures::class
        ]);

        /**
         * @var \Tests\Functional\Controller\EntityManagerInterface $entityManager
         */
        $entityManager = $client->getContainer()->get("doctrine.orm.entity_manager");

        /**
         * @var \Tests\Functional\Controller\Joueur $joueur
         */
        $joueur = $entityManager->getRepository(Joueurs::class)->findOneBy([]);

        $client->request('GET', $urlGenerator->generate("un_joueur", ["id" => $joueur->getId()]));
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
