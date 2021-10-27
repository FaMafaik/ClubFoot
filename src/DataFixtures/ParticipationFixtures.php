<?php

namespace App\DataFixtures;

use App\Entity\Participation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;



class ParticipationFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @return string[]
     */
    public function getDependencies()
    {
        return [

            UsersFixtures::class,
            NiveauFixtures::class,

            EquipeFixtures::class,
            SaisonFixtures::class,
            JoueursFixtures::class,

            EquipeFixtures::class,
            EquipeSaisonJoueurFixtures::class

        ];
    }

    /**
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {

        /**
         * Ici on inscrit la participation des joueurs pour chaque match selon leur équipe
         * 65 matchs sont créés au total
         */
        for ($i = 1; $i <= 65; $i++) {

            /**
             * @var object $match
             */
            $match = $this->getReference('matchs_' . $i);

            /**
             * On récupère les matchs de chaque équipe
             * 
             * @var mixed $matchEquipe
             */
            $matchEquipe = $match->getEquipe();

            /**
             * On récupère les joueurs de chaque équipe par rapport aux matchs
             * 
             * @var mixed $joueursEquipeMatch
             */
            $joueursEquipeMatch = $matchEquipe->getJoueurs();

            foreach ($joueursEquipeMatch as $j => $joueur) {

                /**
                 * @var \App\Entity\Participation $participation
                 */
                $participation = new Participation();

                $participation->setMatchs($match)
                    ->setJoueur($joueur)
                    ->setMinutesJeu(90);

                $this->setReference('participation_' . $j, $participation);
                $manager->persist($participation);
            }
        }

        $manager->flush();
    }
}
