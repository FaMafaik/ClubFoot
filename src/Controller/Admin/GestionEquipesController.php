<?php

namespace App\Controller\Admin;

use App\Entity\Equipe;
use App\Entity\Niveau;
use App\Repository\SaisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionEquipesController extends AbstractController
{
    /**
     * Le controller pour gérer la page des créations d'équipes
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param \App\Repository\SaisonRepository $repoSaison
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/creation-equipes", name="creation_equipes")
     * @IsGranted("ROLE_USER")
     */
    public function creationEquipe(Request $request, EntityManagerInterface $manager, SaisonRepository $repoSaison)
    {
        /**
         * Toutes les saisons dans la variable $saison
         * 
         * @var \App\Entity\Saison[] $saisons
         */
        $saisons = $repoSaison->findAll();

        /**
         * Dernière saison dans la variable $lastsaison parmis la liste des $saisons
         * 
         * @var \App\Entity\Saison $lastSaison
         */
        $lastSaison = end($saisons);

        /**
         * @var \App\Entity\Equipe $equipe
         */
        $equipe = new Equipe();

        /**
         * Formulaire de création d'équipe avec un champ pour le nom  de l'équipe et un champ de sélection pour son niveau
         * 
         * @var \Symfony\Component\Form\FormInterface $form
         */
        $form = $this->createFormBuilder($equipe)
            ->add('nom')
            ->add('niveau', EntityType::class, [
                'class' => Niveau::class,
                'choice_label' => 'libelle',
            ])

            ->getForm()
            ->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($equipe);

            // On ajoute dans l'équipe la dernière saison en cours
            $equipe->addSaison($lastSaison);
            $manager->flush();

            return $this->redirectToRoute('une_equipe', ['id' => $equipe->getId()]);
        }

        return $this->render('admin/creationEquipes.html.twig', [
            'saisons' => $saisons,
            'formEquipe' => $form->createView(),

        ]);
    }
}
