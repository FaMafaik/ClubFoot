<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UsersFixtures extends Fixture
{

    /**
     * @param \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface $passwordHasher
     * @return void
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->_passwordHasher = $passwordHasher;
    }

    /**
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('fr_FR');

        /// ON MET EN PLACE UN UTLISATEUR ADMIN
        $user = new Utilisateur();
        $user->setNom($faker->lastName())
            ->setPrenom($faker->firstNameMale())
            ->setEmail("admin@gmail.com")
            ->setPassword($this->_passwordHasher->hashPassword($user, 'admin123'))
            ->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);

        //On crée un 2ème utilisateur qui aura le rôle user afin de vérifier que les restrictions fonctionnent correctement si l'utilisateur n'a pas le rôle admin
        $user2 = new Utilisateur();
        $user2->setNom($faker->lastName())
            ->setPrenom($faker->firstNameMale())
            ->setEmail("user@gmail.com")
            ->setPassword($this->_passwordHasher->hashPassword($user, 'user123'))
            ->setRoles(array('ROLE_USER'));
        $manager->persist($user2);

        $manager->flush();
    }
}
