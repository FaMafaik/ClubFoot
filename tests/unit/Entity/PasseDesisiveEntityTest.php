<?php

namespace Tests\Unit\Entity;

use App\Entity\Joueurs;
use App\Entity\Matchs;
use App\Entity\PasseDecisive;
use PHPUnit\Framework\TestCase;

class PasseDesisiveEntityUnitTest extends TestCase
{

    /**
     * @return void
     */
    public function testIsTrue(): void
    {
        /**
         * @var \App\Entity\PasseDecisive $passe
         */
        $passe = new PasseDecisive();

        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        /**
         * @var \App\Entity\Matchs $match
         */
        $match = new Matchs();

        $passe->setJoueur($joueur)
            ->setMatchs($match)
            ->setMinutePasse(43);

        $this->assertTrue($passe->getJoueur() === $joueur);
        $this->assertTrue($passe->getMatchs() === $match);
        $this->assertTrue($passe->getMinutePasse() === 43);
    }

    /**
     * @return void
     */
    public function testIsFalse(): void
    {
        /**
         * var \App\Entity\PasseDecisive $passe
         */
        $passe = new PasseDecisive();
        $passe->setMinutePasse(60);
        $this->assertFalse($passe->getMinutePasse() === 80);
    }

    /**
     * @return void
     */
    public function testIsEmpty(): void
    {
        /**
         * @var \App\Entity\PasseDecisive $passe
         */
        $passe = new PasseDecisive();
        $this->assertEmpty($passe->getId());
    }
}
