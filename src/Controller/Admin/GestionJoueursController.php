<?php

namespace App\Controller\Admin;

use App\Entity\Equipe;
use App\Entity\EquipeSaisonJoueur;
use App\Entity\Joueurs;
use App\Repository\EquipeRepository;
use App\Repository\SaisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GestionJoueursController extends AbstractController
{
    /**
     * Le controller pour gérer la page de l'inscription des joueurs
     * 
     * @Route("/admin/inscription-joueurs", name="inscription_joueurs")
     * @IsGranted("ROLE_USER")
     */
    public function inscriptionJoueurs(Request $request, EntityManagerInterface $manager, SaisonRepository $repoSaison, EquipeRepository $repoEquipe)
    {

        /**
         * @var \App\Entity\Joueurs $joueur
         */
        $joueur = new Joueurs();

        /**
         * @var \App\Entity\Saison[] $saisons
         */
        $saisons = $repoSaison->findAll();

        /**
         * @var \App\Entity\Equipe[] $equipes
         */
        $equipes = $repoEquipe->findAll();

        /**
         * @var \App\Entity\Saison $lastSaison
         */
        $lastSaison = end($saisons);

        /**
         * Un array pour la liste des bonnes équipes à afficher dans le formulaire d'inscription des joueurs. 
         * On veut avoir seulement les équipes inscrites pour la dernière saison en cours.
         * 
         * @var array $arrayEquipe
         */
        $arrayEquipe = array();



        /**
         * @var \App\Entity\Equipe[] $equipes
         */
        foreach ($equipes as &$equipe) {

            /**
             * On récupère les saisons de chaque équipe car une équipe peut participer à plusieurs saisons
             * 
             * @var \Doctrine\Common\Collections\Collection $equipeSaisons
             */
            $equipeSaisons = $equipe->getSaison();



            /**
             * On parcours toutes les saisons et on vérifie si parmis la liste des saisons de l'équipe il y'a la dernière saison en cours.
             * Si ces informations sont vérifiées, l'équipe est ajouté dans l'array $arrayEquipe
             */
            foreach ($equipeSaisons as $saison) {
                if ($saison == $lastSaison) {
                    //$equipe = $equipe;

                    array_push($arrayEquipe, $equipe);
                }
            }
        }

        /**
         * Formulaire d'inscription de joueurs
         */
        $form = $this->createFormBuilder($joueur)
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add(
                'dateNaissance',
                BirthdayType::class,
                [
                    'days' => range(1, 31),
                    'months' => range(1, 12),
                    'years' => range(date('Y') - 6, date('Y') - 50)
                ]
            )
            ->add('equipe', EntityType::class, [
                'class' => Equipe::class,
                'multiple' => true,
                'choices' => $arrayEquipe,
                'choice_label' => 'nom',

            ])
            ->getForm()
            ->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($joueur);

            // AJOUTE LE JOUEUR DANS LA DERNIERE SAISON
            $lastSaison->addJoueur($joueur);


            $joueur->addEquipe($equipe);
            $equipe->addJoueur($joueur);

            /**
             * @var \App\Entity\EquipeSaisonJoueur $licence
             */
            $licence = new EquipeSaisonJoueur();

            $licence->setEquipe($equipe);
            $licence->setSaison($lastSaison);
            $licence->setJoueur($joueur);
            $manager->persist($licence);

            $manager->flush();

            return $this->redirectToRoute('un_joueur', ['id' => $joueur->getId()]);
        }

        return $this->render('admin/gestion_joueurs/inscriptionJoueurs.html.twig', [
            'formJoueur' => $form->createView(),

        ]);
    }
}
