<?php

namespace App\Tests;

use App\Entity\Utilisateur;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Trait AthentificationTrait
 * @package App\Tests
 */
trait AuthentificationTrait
{
    public function login(KernelBrowser $client, Utilisateur $user): void
    {
        /**
         * @var object|null $session
         */
        $session = $client->getContainer()->get('session');

        /**
         * @var \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken $token 
         */
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());

        $session->set('_security_main', serialize($token));
        $session->save();

        $client->getCookieJar()->set(new Cookie($session->getName(), $session->getId()));
    }
}
