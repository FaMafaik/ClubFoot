<?php

namespace App\DataFixtures;

use App\Entity\Niveau;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class NiveauFixtures extends Fixture
{

    /**
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {

        // Ici on crée 3 niveaux différents
        for ($i = 1; $i <= 3; $i++) {
            $niveau = new Niveau();
            $niveau->setLibelle("Niveau n°$i");
            $manager->persist($niveau);

            // Enregistre le niveau dans une référence
            $this->addReference('niveau_' . $i, $niveau);
        }
        $manager->flush();
    }
}
