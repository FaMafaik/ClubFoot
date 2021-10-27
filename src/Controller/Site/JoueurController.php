<?php

namespace App\Controller\Site;

use App\Repository\ButRepository;
use App\Repository\EquipeRepository;
use App\Repository\EquipeSaisonJoueurRepository;
use App\Repository\SaisonRepository;
use App\Repository\JoueursRepository;
use App\Repository\MatchsRepository;
use App\Repository\ParticipationRepository;
use App\Repository\PasseDecisiveRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JoueurController extends AbstractController
{

    /**
     * Le controller pour gérer la page de la liste complète des joueurs
     * 
     * @Route("/les-joueurs", name="les_joueurs")
     */
    public function joueurs(JoueursRepository $repo, SaisonRepository $repoSaison)
    {
        /**
         * @var \App\Entity\Saison[] $saisons
         */
        $saisons = $repoSaison->findAll();

        /**
         * @var \App\Entity\Joueurs[] $joueurs 
         */
        $joueurs = $repo->findAll();

        return $this->render('site/joueur/joueurs.html.twig', [
            'controller_name' => 'JoueurController',
            'joueurs' => $joueurs,
            'saisons' => $saisons,


        ]);
    }

    /**
     * Le controller pour gérer la page d'un joueur particulier
     * 
     * @Route("/les-joueurs/{id}", name="un_joueur")
     */
    public function unJoueur(JoueursRepository $repoJoueur, SaisonRepository $repoSaison, ParticipationRepository $repoParticipation, ButRepository $repoBut, PasseDecisiveRepository $repoPasse, EquipeRepository $repoEquipe, EquipeSaisonJoueurRepository $repoLicence, MatchsRepository $repoMatchs, $id)
    {
        /**
         * @var \App\Entity\Joueurs|null $joueur
         */
        $joueur = $repoJoueur->find($id);

        /**
         * @var \App\Entity\EquipeSaisonJoueur[] $licences
         */
        $licences = $repoLicence->findAll();

        /**
         * @var \App\Entity\Equipe[] $equipes 
         */

        /**
         * @var \App\Entity\Equipe[] $equipes
         */
        $equipes = $repoEquipe->findAll();

        /**
         * @var \App\Entity\Saison[] $saisons
         */
        $saisons = $repoSaison->findAll();

        /**
         * @var \App\Entity\Participation[] $participations 
         */
        $participations = $repoParticipation->findAll();


        //////////////////////////////////// VARIABLES POUR LES STATISTIQUES DU JOUEUR
        /**
         * @var \App\Entity\Matchs[] $matchs
         */
        $matchs = $repoMatchs->findAll();

        /**
         * @var \App\Entity\But[] $buts
         */
        $buts = $repoBut->findAll();

        /**
         * @var \App\Entity\PasseDecisive[] $passes
         */
        $passes = $repoPasse->findAll();



        /////////////////////////////////////////////////////////////////////// 
        /**
         * @var \Doctrine\Common\Collections\Collection $equipesJoueur
         */
        $equipesJoueur = $joueur->getEquipe();

        /**
         * @var array $arraySaisonsJoueu
         */
        $arraySaisonsJoueur = array();

        foreach ($saisons as $saison) {

            /**
             * @var mixed[] $joueurs
             */
            $joueurs = $saison->getJoueurs();

            foreach ($joueurs as $valeur) {
                if ($valeur->getId() == $id) {
                    array_push($arraySaisonsJoueur, $saison);
                }
            }
        }



        return $this->render('site/joueur/unJoueur.html.twig', [
            'joueur' => $joueur,
            'saisons' => $saisons,
            'equipesJoueur' => $equipesJoueur,
            'saisonsJoueur' => $arraySaisonsJoueur,
            'equipes' => $equipes,
            'licences' => $licences,
            'matchs' => $matchs,
            'participations' => $participations,
            'buts' => $buts,
            'passes' => $passes

        ]);
    }
}
