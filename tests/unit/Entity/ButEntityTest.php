<?php

namespace Tests\Unit\Entity;

use App\Entity\But;
use App\Entity\Joueurs;
use App\Entity\Matchs;
use PHPUnit\Framework\TestCase;

class ButEntityUnitTest extends TestCase
{

    /**
     * @return void
     */
    public function testIsTrue(): void
    {
        /**
         * @var \App\Entity\But $but
         */
        $but = new But();

        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        /**
         * @var \App\Entity\Matchs $match
         */
        $match = new Matchs();

        $but->setJoueur($joueur)
            ->setMatchs($match)
            ->setMinuteBut(25)
            ->setTypeBut('Tir au but');

        $this->assertTrue($but->getJoueur() === $joueur);
        $this->assertTrue($but->getMatchs() === $match);
        $this->assertTrue($but->getMinuteBut() === 25);
        $this->assertTrue($but->getTypeBut() === 'Tir au but');
    }

    /**
     * @return void
     */
    public function testIsFalse(): void
    {
        /**
         * @var \App\Entity\But $but
         */
        $but = new But();

        $but->setMinuteBut(25)
            ->setTypeBut('Tir au but');

        $this->assertFalse($but->getMinuteBut() === 40);
        $this->assertFalse($but->getTypeBut() === 'Coup franc');
    }

    /**
     * @return void
     */
    public function testIsEmpty(): void
    {
        /**
         * @var \App\Entity\But $but
         */
        $but = new But();

        $this->assertEmpty($but->getId());
    }
}
