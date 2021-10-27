<?php

namespace Tests\Unit\Entity;

use App\Entity\Equipe;
use App\Entity\Matchs;
use App\Entity\Saison;
use DateTime;
use PHPUnit\Framework\TestCase;

class MatchsEntityUnitTest extends TestCase
{

    public function testIsTrue(): void
    {
        /**
         * @var \App\Entity\Matchs $match
         */
        $match = new Matchs();

        /**
         * @var \App\Entity\Equipe $equipe
         */
        $equipe = new Equipe();

        /**
         * @var \DateTime $dateMatch
         */
        $dateMatch = new DateTime();

        /**
         * @var string $strHeures
         */
        $strHeures =  $dateMatch->format($format = 'H:i:s');

        /**
         * @var \DateTime|false $dateHeures
         */
        $dateHeures = DateTime::createFromFormat($format, $strHeures);

        $match->setHeureMatch(DateTime::createFromFormat($format, $strHeures));



        $match->setLibelle('Match 1')
            ->setDateMatch($dateMatch)
            ->setEquipe($equipe)
            ->setHeureMatch($dateHeures);

        $this->assertTrue($match->getLibelle() === 'Match 1');
        $this->assertTrue($match->getDateMatch() === $dateMatch);
        $this->assertTrue($match->getEquipe() === $equipe);
        $this->assertTrue($match->getHeureMatch() === $dateHeures);
    }


    public function testIsEmpty(): void
    {
        /**
         * @var \App\Entity\Matchs $match
         */
        $match = new Matchs();

        $this->assertEmpty($match->getId());
    }

    public function testAddGetRemoveSaison(): void
    {
        /**
         * @var \App\Entity\Matchs $match
         */
        $match = new Matchs();

        /**
         * @var \App\Entity\Saison $saison
         */
        $saison = new Saison();

        $this->assertEmpty($match->getSaison());

        $match->addSaison($saison);
        $this->assertContains($saison, $match->getSaison());

        $match->removeSaison($saison);
        $this->assertEmpty($match->getSaison());
    }
}
