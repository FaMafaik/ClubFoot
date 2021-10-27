<?php

namespace App\DataFixtures;

use App\Entity\Joueurs;
use App\DataFixtures\EquipeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class JoueursFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @return string[]
     */
    public function getDependencies()
    {
        return [
            EquipeFixtures::class,
            SaisonFixtures::class
        ];
    }

    /**
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');


        /**
         * Ici les joueurs sont créés
         * 
         * 44 Joueurs sont créés pour les tests du site
         * Les joueurs sont différents pour chaque équipe et chaque joueur est inscrit pour 3 saisons différentes
         * Pour la dernière équipe on récupère des anciens joueurs dans une 4ème saison qui sera ajouté (Saison 2021/2022)
         */
        for ($i = 1; $i <= 11 * 4; $i++) {

            /**
             * @return void
             */
            $joueur = new Joueurs();

            $joueur->setNom($faker->lastName);
            $joueur->setPrenom($faker->firstNameMale);
            $joueur->setEmail($faker->email);
            $joueur->setDateNaissance($faker->dateTime($max = 'now'));
            $joueur->setPhotoJoueur('https://style.anu.edu.au/_anu/4/images/placeholders/person_8x10.png');

            switch ($i) {
                case $i <= 11:
                    /**
                     * @var object $equipe
                     */
                    $equipe = $this->getReference('equipe_' . 1);
                    $joueur->addEquipe($equipe);
                    $equipe->addJoueur($joueur);

                    $saison = $this->getReference('saison_' . 1);
                    $saison->addJoueur($joueur);
                    $saison = $this->getReference('saison_' . 2);
                    $saison->addJoueur($joueur);
                    $saison = $this->getReference('saison_' . 3);
                    $saison->addJoueur($joueur);

                    break;
                case $i > 11 && $i <= 22:
                    $equipe = $this->getReference('equipe_' . 2);
                    $joueur->addEquipe($equipe);
                    $equipe->addJoueur($joueur);

                    $saison = $this->getReference('saison_' . 1);
                    $saison->addJoueur($joueur);
                    $saison = $this->getReference('saison_' . 2);
                    $saison->addJoueur($joueur);
                    $saison = $this->getReference('saison_' . 3);
                    $saison->addJoueur($joueur);

                    break;
                case $i > 22 && $i <= 33:
                    $equipe = $this->getReference('equipe_' . 3);
                    $joueur->addEquipe($equipe);
                    $equipe->addJoueur($joueur);

                    $saison = $this->getReference('saison_' . 1);
                    $saison->addJoueur($joueur);
                    $saison = $this->getReference('saison_' . 2);
                    $saison->addJoueur($joueur);
                    $saison = $this->getReference('saison_' . 3);
                    $saison->addJoueur($joueur);


                    if ($i > 28 && $i <= 33) {
                        $equipe = $this->getReference('equipe_' . 4);
                        $joueur->addEquipe($equipe);
                        $equipe->addJoueur($joueur);

                        $saison = $this->getReference('saison_' . 4);
                        $saison->addJoueur($joueur);
                    }

                    break;

                case $i > 33 && $i <= 44:
                    $equipe = $this->getReference('equipe_' . 4);
                    $joueur->addEquipe($equipe);
                    $equipe->addJoueur($joueur);

                    $saison = $this->getReference('saison_' . 1);
                    $saison->addJoueur($joueur);

                    $saison = $this->getReference('saison_' . 2);
                    $saison->addJoueur($joueur);
                    $saison = $this->getReference('saison_' . 3);
                    $saison->addJoueur($joueur);

                    if ($i > 38 && $i <= 44) {
                        $equipe = $this->getReference('equipe_' . 4);
                        $joueur->addEquipe($equipe);
                        $equipe->addJoueur($joueur);

                        $saison = $this->getReference('saison_' . 4);
                        $saison->addJoueur($joueur);
                    }

                    break;
            }

            $manager->persist($joueur);

            $this->addReference('joueur_' . $i, $joueur);
        }

        $manager->flush();
    }
}
