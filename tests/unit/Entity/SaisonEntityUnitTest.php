<?php

namespace Tests\Unit\Entity;

use App\Entity\Joueurs;
use App\Entity\Saison;

use PHPUnit\Framework\TestCase;

class SaisonEntityUnitTest extends TestCase
{

    /**
     * @return void
     */
    public function testIsTrue(): void
    {
        /**
         * @var \App\Entity\Saison $saison
         */
        $saison = new Saison();

        $saison->setLibelle('Saison 1');
        $this->assertTrue($saison->getLibelle() === 'Saison 1');
    }

    public function testIsFalse(): void
    {
        /**
         * @var \App\Entity\Saison $saison
         */
        $saison = new Saison();

        $saison->setLibelle('Saison true');
        $this->assertFalse($saison->getLibelle() === 'Saison false');
    }

    /**
     * @return void
     */
    public function testIsEmpty(): void
    {
        /**
         * @var \App\Entity\Saison $saison
         */
        $saison = new Saison();

        $this->assertEmpty($saison->getId());
        $this->assertEmpty($saison->getLibelle());
    }

    /**
     * @return void
     */
    public function testAddGetRemoveJoueur(): void
    {
        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        /**
         * @var \App\Entity\Saison $saison
         */
        $saison = new Saison();

        $this->assertEmpty($saison->getJoueurs());

        $saison->addJoueur($joueur);
        $this->assertContains($joueur, $saison->getJoueurs());

        $saison->removeJoueur($joueur);
        $this->assertEmpty($saison->getJoueurs());
    }
}
