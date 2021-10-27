<?php

namespace Tests\Unit\Entity;

use DateTime;
use App\Entity\Equipe;
use App\Entity\Joueurs;
use PHPUnit\Framework\TestCase;


class JoueursEntityUnitTest extends TestCase
{

    /**
     * @return void
     */
    public function testIsTrue(): void
    {
        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        /**
         * @var \DateTime $date
         */
        $date = new DateTime();

        $joueur->setNom('Nom')
            ->setPrenom('prenom')
            ->setDateNaissance($date)
            ->setEmail('mail@gmail.com')
            ->setPhotoJoueur('https://via.placeholder.com/150');

        $this->assertTrue($joueur->getNom() === 'Nom');
        $this->assertTrue($joueur->getPrenom() === 'prenom');
        $this->assertTrue($joueur->getEmail() === 'mail@gmail.com');
        $this->assertTrue($joueur->getDateNaissance() === $date);
        $this->assertTrue($joueur->getPhotoJoueur() === 'https://via.placeholder.com/150');
    }

    /**
     * @return void
     */
    public function testIsFalse(): void
    {
        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        $joueur->setNom('Nom true')
            ->setPrenom('Prenom true')
            ->setDateNaissance(new DateTime())
            ->setEmail('true@gmail.com')
            ->setPhotoJoueur('phototrue');

        $this->assertFalse($joueur->getNom() === 'false Nom');
        $this->assertFalse($joueur->getPrenom() === 'false Prenom');
        $this->assertFalse($joueur->getEmail() === 'false email');
        $this->assertFalse($joueur->getDateNaissance() === new DateTime());
        $this->assertFalse($joueur->getPhotoJoueur() === 'false image');
    }

    /**
     * @return void
     */
    public function testIsEmpty(): void
    {
        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        $this->assertEmpty($joueur->getId());
        $this->assertEmpty($joueur->getNom());
        $this->assertEmpty($joueur->getPrenom());
        $this->assertEmpty($joueur->getEmail());
        $this->assertEmpty($joueur->getDateNaissance());
        $this->assertEmpty($joueur->getPhotoJoueur());
    }

    /**
     * @return void
     */
    public function testAddGetRemoveEquipe(): void
    {
        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        /**
         * @var \App\Entity\Equipe $equipe
         */
        $equipe = new Equipe();

        $this->assertEmpty($joueur->getEquipe());

        $joueur->addEquipe($equipe);
        $this->assertContains($equipe, $joueur->getEquipe());

        $joueur->removeEquipe($equipe);
        $this->assertEmpty($joueur->getEquipe());
    }
}
