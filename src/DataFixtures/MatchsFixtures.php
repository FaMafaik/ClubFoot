<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Matchs;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class MatchsFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @return string[]
     */
    public function getDependencies()
    {
        return [
            SaisonFixtures::class,
            EquipeFixtures::class,
            SaisonFixtures::class,
            JoueursFixtures::class,
            EquipeSaisonJoueurFixtures::class
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
         * Il y'aura 5 matchs pour les 4 équipes et pour chaque saison
         * 
         * @var int $m
         */
        $m = 0;


        /**
         * Ici on parcourt la liste des équipes, 4 équipes ont été créés pour tester le site
         */
        for ($i = 1; $i <= 4; $i++) {

            /**
             * @var object $equipe
             */
            $equipe = $this->getReference('equipe_' . $i);

            /**
             * On récupère le nombre de saisons de chaque équipe 
             * 
             * @var int $nbSaisonsEquipe
             */
            $nbSaisonsEquipe = count($equipe->getSaison());

            for ($j = 1; $j <= $nbSaisonsEquipe; $j++) {
                $saison = $this->getReference('saison_' . $j);

                for ($k = 1; $k <= 5; $k++) {

                    /**
                     * @var \App\Entity\Matchs $match
                     */
                    $match = new Matchs();
                    $m++;
                    $match->setLibelle("match n°$k")
                        ->setDateMatch($faker->dateTime());

                    /**
                     * @var string $strHeures
                     */
                    $strHeures = $faker->time($format = 'H:i:s');

                    $match->setHeureMatch(DateTime::createFromFormat($format, $strHeures));
                    $match->setEquipe($equipe);
                    $match->addSaison($saison);

                    $this->addReference('matchs_' . $m, $match);
                    $manager->persist($match);
                }
            }
        }

        $manager->flush();
    }
}
