<?php

namespace Tests\Functional\Controller;

use App\DataFixtures\UsersFixtures;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class SecurityControllerTest extends WebTestCase
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

    // TEST L AFFICHAGE DE LA PAGE DE CONNEXION
    public function testDisplayLogin(): void
    {
        $this->testClient->request('GET', '/login');
        $this->assertSelectorTextContains('h1', 'Connectez vous');
        $this->assertSelectorNotExists('.alert.alert-danger');
    }


    //TEST LE FORMULAIRE DE CONNEXION LORSQUE LES INFORMATIONS RENTREES SONT ERRONNES 
    public function testLoginWithBadCredentials(): void
    {
        /**
         * @var mixed $client
         */
        $client = $this->testClient;

        /**
         * @var mixed $crawler
         */
        $crawler = $this->testClient->request('GET', '/login');

        // ON SELECTIONNE UN OBJET ICI LE BOUTON DE CONNEXION POUR RECUPERER TOUT LES INFORMATIONS DU FORMULAIRE
        /**
         * @var mixed $form
         */
        $form = $crawler->selectButton('Se connecter')->form([
            'email' => 'admin@gmail.com',
            'password' => 'testpassword'
        ]);
        $client->submit($form);


        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        //ON TEST LA REDIRECTION DE LA PAGE
        $this->assertRouteSame('app_login');
        $this->assertSelectorExists('.alert.alert-danger');
    }

    // TEST LE FORMULAIRE DE CONNEXION LORSQUE LES INFORMATIONS RENTREES SONT CORRECTES
    public function testSuccessfullLogin(): void
    {
        /**
         * @var mixed $client
         */
        $client = $this->testClient;

        /**
         * @var mixed $crawler
         */
        $crawler = $client->request('GET', '/login');


        $this->databaseTool->loadFixtures([
            UsersFixtures::class
        ]);

        /**
         * @var mixed $form
         */
        $form = $crawler->selectButton('Se connecter')->form([
            'email' => 'admin@gmail.com',
            'password' => 'admin123'
        ]);
        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();
        $this->assertRouteSame('home');
    }
}
