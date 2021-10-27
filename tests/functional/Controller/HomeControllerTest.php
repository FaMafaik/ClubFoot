<?php

namespace Tests\Functional\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{

    //TEST SI IL N'Y A PAS D'ERREURS SUR LA PAGE HOME
    public function testHomePageIsUp(): void
    {
        /**
         * @var \Symfony\Bundle\FrameworkBundle\KernelBrowser $client
         */
        $client =  static::createClient();
        $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    // TEST SI LE H1 CORRESPOND BIEN A LA PAGE HOME
    public function testH1HomePage(): void
    {
        /**
         * @var \Symfony\Bundle\FrameworkBundle\KernelBrowser $client
         */
        $client =  static::createClient();
        $client->request('GET', '/');
        $this->assertSelectorTextContains('h1', 'Bienvenue sur Club Foot');
    }
}
