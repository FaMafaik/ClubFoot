<?php

namespace App\DataFixtures;

use App\Entity\Saison;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class SaisonFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @return string[]
     */
    public function getDependencies()
    {
        return [
            EquipeFixtures::class,
        ];
    }

    /**
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {

        /**
         * On créé 3 saisons différentes dans un premier temps
         */
        for ($i = 1; $i <= 3; $i++) {

            /**
             * @var \App\Entity\Saison $saison
             */
            $saison = new Saison();
            $saison->setLibelle("Saison n°$i");

            // Pour chaque équipe on lui ajoute la saison correspondant
            // 4 équipes sont créés au total
            for ($j = 1; $j <= 4; $j++) {
                $equipe = $this->getReference('equipe_' . $j);
                $equipe->addSaison($saison);
            }

            $manager->persist($saison);

            // Enregistre le niveau dans une référence
            $this->addReference('saison_' . $i, $saison);
        }

        /**
         * On crée une 4ème saison qui doit être la dernière saison donc la saison présente
         * 
         * @var \App\Entity\Saison $saison
         */
        $saison = new Saison();
        $saison->setLibelle("2021-2022");


        $manager->persist($saison);

        // Enregistre le niveau dans une référence
        $this->addReference('saison_' . 4, $saison);

        /**
         * @var object $equipe
         */
        $equipe = $this->getReference('equipe_' . 4);
        $equipe->addSaison($saison);


        $manager->flush();
    }
}
