<?php

namespace Tests\Functional\Controller;

use App\Entity\Utilisateur;
use App\DataFixtures\UsersFixtures;
use App\DataFixtures\NiveauFixtures;
use App\DataFixtures\SaisonFixtures;
use App\Tests\AuthentificationTrait;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class GestionEquipesControllerTest extends WebTestCase
{
    /**
     * @var mixed $databaseTool
     */
    protected $databaseTool;

    /**
     * @var mixed $testClient
     */
    private $testClient = null;

    /**
     * @package App\Tests
     */
    use AuthentificationTrait;

    public function setUp(): void
    {
        $this->testClient = static::createClient();
        $this->databaseTool = $this->testClient->getContainer()->get(DatabaseToolCollection::class)->get();
    }

    //TEST SI IL N'Y A PAS D'ERREURS SUR LA PAGE HOME
    public function testGestionEquipesPageIsUp(): void
    {
        /**
         * @var mixed $client
         */
        $client =  $this->testClient;

        $this->databaseTool->loadFixtures([
            UsersFixtures::class
        ]);

        /**
         * @var mixed $user
         */
        $user = self::$kernel->getContainer()->get('doctrine')->getRepository(Utilisateur::class)->findOneByEmail('admin@gmail.com');
        $this->login($client, $user);

        $client->request('GET', '/admin/creation-equipes');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testSuccessfullFormGestionEquipes(): void
    {
        /**
         * @var mixed $client
         */
        $client =  $this->testClient;

        $this->databaseTool->loadFixtures([
            UsersFixtures::class,
            SaisonFixtures::class,
            NiveauFixtures::class
        ]);


        /**
         * @var mixed $user
         */
        $user = self::$kernel->getContainer()->get('doctrine')->getRepository(Utilisateur::class)->findOneByEmail('admin@gmail.com');
        $this->login($client, $user);

        /**
         * @var mixed $crawler
         */
        $crawler = $client->request('GET', '/admin/creation-equipes');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);


        // ON VEUT COMPTER LE NOMBRE D EQUIPES AVANT L ENREGISTREMENT
        /**
         * @var \Symfony\Component\HttpKernel\KernelInterface $kernel 
         */
        $kernel = static::createKernel();
        $kernel->boot();

        /**
         * @var object|null $em
         */
        $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');

        /**
         * @var mixed $query
         */
        $query = $em->createQuery('SELECT COUNT(e.id) FROM App\Entity\Equipe e');

        //4 équipes sont enregistrés par défaut
        $this->assertTrue(3 < $query->getSingleScalarResult());


        // ON PROCEDE A L ENREGISTREMENT DU FORMULAIRE
        /**
         * @var mixed $form
         */
        $form = $crawler->selectButton("Créer l'équipe")->form([
            'form[nom]' => 'Equipe delta',
            'form[niveau]' => 1
        ]);

        $client->submit($form);

        //une 5ème équipe s'ajoute
        $this->assertTrue(4 < $query->getSingleScalarResult());

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertSelectorTextContains('html', "L'équipe");
    }
}
