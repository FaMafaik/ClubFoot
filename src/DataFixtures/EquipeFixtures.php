<?php

namespace App\DataFixtures;

use App\Entity\Equipe;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EquipeFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @return string[]
     */
    public function getDependencies()
    {
        return [
            UsersFixtures::class,
            NiveauFixtures::class,
        ];
    }

    /**
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {

        /**
         * @var \Faker\Generator $faker
         */
        $faker = \Faker\Factory::create('fr_FR');


        for ($nbEquipes = 1; $nbEquipes <= 4; $nbEquipes++) {

            /**
             * @var object $niveau
             */
            $niveau = $this->getReference('niveau_' . $faker->numberBetween(1, 2));

            /**
             * @var \App\Entity\Equipe $equipe
             */
            $equipe = new Equipe();
            $equipe->setNom($faker->country());
            $equipe->setNiveau($niveau);
            $manager->persist($equipe);

            //Enregistre l'équipe dans une référence
            $this->addReference('equipe_' . $nbEquipes, $equipe);
        }

        $manager->flush();
    }
}
