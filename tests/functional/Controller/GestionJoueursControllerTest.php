<?php

namespace Tests\Functional\Controller;

use App\Entity\Utilisateur;
use App\DataFixtures\UsersFixtures;
use App\DataFixtures\EquipeFixtures;
use App\DataFixtures\NiveauFixtures;
use App\Tests\AuthentificationTrait;
use App\DataFixtures\SaisonFixtures;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;


class GestionJoueurControllerTest extends WebTestCase
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
    public function testGestionJoueurPageIsUp(): void
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
        $client->request('GET', '/admin/inscription-joueurs');
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
            NiveauFixtures::class,
            EquipeFixtures::class,
            SaisonFixtures::class
        ]);

        /**
         * @var mixed $user
         */
        $user = self::$kernel->getContainer()->get('doctrine')->getRepository(Utilisateur::class)->findOneByEmail('admin@gmail.com');
        $this->login($client, $user);

        /**
         * @var mixed $crawler 
         */
        $crawler = $client->request('GET', '/admin/inscription-joueurs');
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
         * @var mixed $queryA
         */
        $queryA = $em->createQuery('SELECT COUNT(j.id) FROM App\Entity\Joueurs j')->getSingleScalarResult();

        // ON PROCEDE A L ENREGISTREMENT
        /** 
         * @var mixed $form
         */
        $form = $crawler->selectButton("Inscrire le joueur")->form([
            'form[nom]' => 'Victor',
            'form[prenom]' => 'Reiss',
            'form[email]' => 'victor@gmail.com',
            'form[dateNaissance][day]' => 11,
            'form[dateNaissance][month]' => 5,
            'form[dateNaissance][year]' => 2000,
            'form[equipe]' => 4

        ]);

        $client->submit($form);

        // ON VERIFIE QUE L ENREGISTREMENT EST BIEN PRIS EN COMPTE
        /**
         * @var mixed $queryB
         */
        $queryB = $em->createQuery('SELECT COUNT(j.id) FROM App\Entity\Joueurs j')->getSingleScalarResult();

        $this->assertTrue($queryA < $queryB);


        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
    }
}
