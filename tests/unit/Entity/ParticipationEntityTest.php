<?php

namespace Tests\Unit\Entity;

use App\Entity\Joueurs;
use App\Entity\Matchs;
use App\Entity\Participation;
use PHPUnit\Framework\TestCase;

class ParticipationEntityUnitTest extends TestCase
{

    /**
     * @return void
     */
    public function testIsTrue(): void
    {
        /**
         * @var \App\Entity\Participation $participation
         */
        $participation = new Participation();

        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        /**
         * @var \App\Entity\Matchs $match
         */
        $match = new Matchs();

        $participation->setJoueur($joueur)
            ->setMatchs($match)
            ->setMinutesJeu(60);

        $this->assertTrue($participation->getJoueur() === $joueur);
        $this->assertTrue($participation->getMatchs() === $match);
        $this->assertTrue($participation->getMinutesJeu() === 60);
    }

    /**
     * @return void
     */
    public function testIsFalse(): void
    {
        /**
         * @var \App\Entity\Participation $participation
         */
        $participation = new Participation();

        $participation->setMinutesJeu(60);
        $this->assertFalse($participation->getMinutesJeu() === 80);
    }

    /**
     * @return void
     */
    public function testIsEmpty(): void
    {
        /**
         * @var \App\Entity\Participation $participation
         */
        $participation = new Participation();
        $this->assertEmpty($participation->getId());
    }
}
