<?php

namespace Tests\Unit\Entity;

use App\Entity\Utilisateur;
use PHPUnit\Framework\TestCase;


class UtilisateurEntityUnitTest extends TestCase
{

    /**
     * @return void
     */
    public function testIsTrue(): void
    {

        /**
         * @var \App\Entity\Utilisateur $user
         */
        $user = new Utilisateur();
        $user->setNom('Noom')
            ->setPrenom('Prenoom')
            ->setEmail('monemail@gmail.com');

        $this->assertTrue($user->getNom() === 'Noom');
        $this->assertTrue($user->getPrenom() === 'Prenoom');
        $this->assertTrue($user->getEmail() === 'monemail@gmail.com');
    }

    /**
     * @return void
     */
    public function testIsEmpty(): void
    {
        $user = new Utilisateur();

        $this->assertEmpty($user->getId());
    }
}
