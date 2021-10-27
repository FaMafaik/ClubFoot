<?php

namespace Tests\Unit\Entity;


use App\Entity\Equipe;

use PHPUnit\Framework\TestCase;
use App\Entity\EquipeSaisonJoueur;
use App\Entity\Joueurs;
use App\Entity\Saison;

class EquipeSaisonJoueurEntityUnitTest extends TestCase
{

    /**
     * @return void
     */
    public function testIsTrue(): void
    {
        /**
         * @var \App\Entity\EquipeSaisonJoueur $licence
         */
        $licence = new EquipeSaisonJoueur();

        /**
         * @var \App\Entity\Equipe $equipe
         */
        $equipe = new Equipe();

        /**
         * @var \App\Entity\Saison $saison
         */
        $saison = new Saison();

        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        $licence->setEquipe($equipe);
        $licence->setSaison($saison);
        $licence->setJoueur($joueur);

        $this->assertTrue($licence->getEquipe() === $equipe);
        $this->assertTrue($licence->getSaison() === $saison);
        $this->assertTrue($licence->getJoueur() === $joueur);
    }

    /**
     * @return void
     */
    public function testIsEmpty(): void
    {
        /**
         * @var \App\Entity\EquipeSaisonJoueur $licence
         */
        $licence = new EquipeSaisonJoueur();

        $this->assertEmpty($licence->getId());
    }
}
