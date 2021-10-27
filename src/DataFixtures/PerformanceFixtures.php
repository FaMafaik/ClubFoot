<?php

namespace App\DataFixtures;

use App\Entity\But;
use App\Entity\PasseDecisive;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class PerformanceFixtures extends Fixture implements DependentFixtureInterface
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
            EquipeSaisonJoueurFixtures::class,

        ];
    }

    /**
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        /**
         * Ici on met en place les statistiques aléatoirement pour chaque joueur qui participe à un match quelconque
         * 
         * 65 matchs ont été créés au total
         */
        for ($i = 1; $i <= 65; $i++) {

            /**
             * @var object $match
             */
            $match = $this->getReference('matchs_' . $i);

            /**
             * On récupère l'équipe de chaque match correspondant
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
                 * @var int $nbAleatoireA
                 */
                $nbAleatoireA = rand(0, 1);

                /**
                 * @var int $nbAleatoireB
                 */
                $nbAleatoireB = rand(0, 1);

                if ($nbAleatoireA == 1) {

                    /**
                     * @var int $nbButsAleatoire
                     */
                    $nbButsAleatoire = rand(1, 3);

                    for ($k = 1; $k <= $nbButsAleatoire; $k++) {

                        /**
                         * @var \App\Entity\But $but
                         */
                        $but = new But();
                        $but->setJoueur($joueur)
                            ->setMatchs($match);

                        $manager->persist($but);
                    }
                }

                if ($nbAleatoireB == 1) {

                    /**
                     * @var int $nbPassesAleatoire
                     */
                    $nbPassesAleatoire = rand(1, 3);

                    for ($k = 1; $k <= $nbPassesAleatoire; $k++) {
                        /**
                         * @var \App\Entity\PasseDecisive $passe
                         */
                        $passe = new PasseDecisive();
                        $passe->setJoueur($joueur)
                            ->setMatchs($match);
                        $manager->persist($passe);
                    }
                }
            }
        }

        $manager->flush();
    }
}
