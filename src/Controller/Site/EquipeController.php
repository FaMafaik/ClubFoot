<?php

namespace App\Controller\Site;

use App\Entity\Equipe;
use App\Repository\EquipeRepository;
use App\Repository\SaisonRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EquipeSaisonJoueurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EquipeController extends AbstractController
{


    /**
     * Le controller pour gérer la page qui affiche la liste complète des équipes
     * 
     * @param \App\Repository\SaisonRepository $repoSaison
     * @param \App\Repository\EquipeRepository $repo
     * @return \Symfony\Component\HttpFoundation\Response
     * @route("/les-equipes", name="les_equipes")
     */
    public function equipes(SaisonRepository $repoSaison, EquipeRepository $repo)
    {
        /**
         * @var \App\Entity\Saison[] $saisons
         */
        $saisons = $repoSaison->findAll();

        /**
         * @var \App\Entity\Equipe[] $equipes
         */
        $equipes = $repo->findAll();


        return $this->render('site/equipe/equipes.html.twig', [
            'controller_name' => 'EquipeController',
            'saisons' => $saisons,
            'equipes' => $equipes
        ]);
    }

    /**
     * Le controller pour gérer la page d'une équipe particulière avec la liste de ses joueurs par saison
     * 
     * @param \App\Repository\SaisonRepository $repoSaison
     * @param \App\Repository\EquipeSaisonJoueurRepository $repoLicence
     * @param \App\Entity\Equipe $equipe
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/les-equipes/{id}", name="une_equipe")
     */
    public function uneEquipe(SaisonRepository $repoSaison, EquipeSaisonJoueurRepository $repoLicence, Equipe $equipe)
    {
        /**
         * @var \App\Entity\Saison[] $saisons
         */
        $saisons = $repoSaison->findAll();

        /**
         * @var \Doctrine\Common\Collections\Collection $saisonsEquipe
         */
        $saisonsEquipe = $equipe->getSaison();

        /**
         * @var \App\Entity\EquipeSaisonJoueur[] $licences
         */
        $licences = $repoLicence->findAll();


        return $this->render('site/equipe/uneEquipe.html.twig', [
            'equipe' => $equipe,
            'saisons' => $saisons,
            'saisonsEquipe' => $saisonsEquipe,
            'licences' => $licences

        ]);
    }
}
