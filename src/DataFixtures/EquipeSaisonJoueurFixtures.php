<?php

namespace App\DataFixtures;

use App\Entity\EquipeSaisonJoueur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class EquipeSaisonJoueurFixtures extends Fixture implements DependentFixtureInterface

{

    /**
     * @return string[]
     */
    public function getDependencies()
    {
        return [
            UsersFixtures::class,
            NiveauFixtures::class,
            SaisonFixtures::class,
            JoueursFixtures::class



        ];
    }

    /**
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {

        // ON PARCOURS LA LISTE DE TOUT LES JOUEURS. 44 Joueurs ont été créés pour les tests.
        // LES JOUEURS SONT DIFFERENTS POUR CHAQUES EQUIPES ET CHAQUE EQUIPE EST INSCRIT POUR 3 SAISONS
        // POUR LA DERNIERE EQUIPE ONT RECUPERE DES ANCIENS JOUEURS DANS UNE 4EME SAISON QUI SERA AJOUTE (SAISON 2021/2022)

        /**
         * Ici on remplit l'entité EquipeSaisonJoueur (On créé une licence pour chaque joueur)
         * 
         * On parcours la liste de tout les joueurs. 44 joueurs ont été créés pour les tests
         * Dans cette boucle on enregistre les informations (equipe_id, saison_id, joueur_id) de l'entité EquipeSaisonJoueur dans la base de données
         */
        for ($i = 1; $i <= 11 * 4; $i++) {

            /**
             * @var object $joueur
             */
            $joueur = $this->getReference('joueur_' . $i);

            switch ($i) {
                case $i <= 11:

                    /**
                     * @var object $equipe
                     */
                    $equipe = $this->getReference('equipe_' . 1);

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 1);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();
                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 2);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 3);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);


                    break;
                case $i > 11 && $i <= 22:

                    /**
                     * @var object $equipe
                     */
                    $equipe = $this->getReference('equipe_' . 2);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 1);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 2);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 3);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    break;
                case $i > 22 && $i <= 33:
                    /**
                     * @var object $equipe
                     */
                    $equipe = $this->getReference('equipe_' . 3);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 1);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 2);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 3);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    if ($i > 28 && $i <= 33) {

                        /**
                         * @var \App\Entity\EquipeSaisonJoueur $licence
                         */
                        $licence = new EquipeSaisonJoueur();

                        /**
                         * @var object $equipe
                         */
                        $equipe = $this->getReference('equipe_' . 4);

                        /**
                         * @var object $saison
                         */
                        $saison = $this->getReference('saison_' . 4);

                        $licence->setJoueur($joueur);
                        $licence->setEquipe($equipe);
                        $licence->setSaison($saison);

                        $this->setReference('licence_' . $i, $licence);
                        $manager->persist($licence);
                    }
                    break;

                case $i > 33 && $i <= 44:

                    /**
                     * @var object $equipe
                     */
                    $equipe = $this->getReference('equipe_' . 4);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 1);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison 
                     */
                    $saison = $this->getReference('saison_' . 2);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    /**
                     * @var \App\Entity\EquipeSaisonJoueur $licence
                     */
                    $licence = new EquipeSaisonJoueur();

                    /**
                     * @var object $saison
                     */
                    $saison = $this->getReference('saison_' . 3);

                    $licence->setJoueur($joueur);
                    $licence->setEquipe($equipe);
                    $licence->setSaison($saison);

                    $this->setReference('licence_' . $i, $licence);
                    $manager->persist($licence);

                    if ($i > 38 && $i <= 44) {

                        /**
                         * @var \App\Entity\EquipeSaisonJoueur $licence
                         */
                        $licence = new EquipeSaisonJoueur();

                        /**
                         * @var object $equipe
                         */
                        $equipe = $this->getReference('equipe_' . 4);

                        /**
                         * @var object $saison
                         */
                        $saison = $this->getReference('saison_' . 4);

                        $licence->setJoueur($joueur);
                        $licence->setEquipe($equipe);
                        $licence->setSaison($saison);

                        $this->setReference('licence_' . $i, $licence);
                        $manager->persist($licence);
                    }

                    break;
            }
        }

        $manager->flush();
    }
}
