<?php

namespace Tests\Unit\Entity;

use App\Entity\Equipe;
use App\Entity\Joueurs;
use App\Entity\Niveau;
use App\Entity\Saison;
use PHPUnit\Framework\TestCase;

class EquipeEntityUnitTest extends TestCase
{

    /**
     * @return void
     */
    public function testIsTrue(): void
    {
        /**
         * @var \App\Entity\Equipe $equipe
         */
        $equipe = new Equipe();

        /**
         * @var \App\Entity\Niveau $niveau
         */
        $niveau = new Niveau();

        $niveau->setLibelle('Niveau 1');

        $equipe->setNom('Equipe 1')
            ->setNiveau($niveau);

        $this->assertTrue($equipe->getNom() === 'Equipe 1');
        $this->assertTrue($equipe->getNiveau() === $niveau);
    }

    /**
     * @return void
     */
    public function testIsFalse(): void
    {
        /**
         * @var \App\Entity\Equipe $equipe
         */
        $equipe = new Equipe();

        /**
         * @var \App\Entity\Niveau $niveau
         */
        $niveau = new Niveau();

        $niveau->setLibelle('Niveau true');

        $equipe->setNom('Equipe true')
            ->setNiveau($niveau);

        $this->assertFalse($equipe->getNom() === 'false');
        $this->assertFalse($equipe->getNiveau() === 'false');
    }

    /**
     * @return void
     */
    public function testIsEmpty(): void
    {
        /**
         * @var \App\Entity\Equipe $niveau
         */
        $niveau = new Equipe();

        /**
         * @var \App\Entity\Equipe $equipe
         */
        $equipe = new Equipe();


        $this->assertEmpty($niveau->getId());
        $this->assertEmpty($equipe->getNom());
        $this->assertEmpty($equipe->getNiveau());
    }

    /**
     * @return void
     */
    public function testAddGetRemoveSaison(): void
    {
        /**
         * @var \App\Entity\Equipe $equipe
         */
        $equipe = new Equipe();

        /**
         * @var \App\Entity\Saison $saison
         */
        $saison = new Saison();

        $this->assertEmpty($equipe->getSaison());

        $equipe->addSaison($saison);
        $this->assertContains($saison, $equipe->getSaison());

        $equipe->removeSaison($saison);
        $this->assertEmpty($equipe->getSaison());
    }

    /**
     * @return void
     */
    public function testAddGetRemoveJoueur(): void
    {
        /**
         * @var \App\Entity\Equipe $equipe
         */
        $equipe = new Equipe();

        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        $this->assertEmpty($equipe->getJoueurs());

        $equipe->addJoueur($joueur);
        $this->assertContains($joueur, $equipe->getJoueurs());

        $equipe->removeJoueur($joueur);
        $this->assertEmpty($equipe->getJoueurs());
    }
}
