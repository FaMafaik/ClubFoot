<?php

namespace App\Controller\Site;


use App\Repository\EquipeRepository;
use App\Repository\SaisonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SaisonController extends AbstractController
{
    /**
     * Le controller pour gérer la page de la liste complète des saisons du club avec d'autres informations
     * Remarque : Cette page n'est pas utilisé sur  le site car elle n'est pas nécessaire pour l'instant
     * 
     * @Route("/saisons", name="saison")
     */
    public function saison(SaisonRepository $saisonRepo): Response
    {

        /**
         * @var \App\Entity\Saison[] $saisons
         */
        $saisons = $saisonRepo->findAll();
        return $this->render('site/saison/saisons.html.twig', [
            'controller_name' => 'SaisonController',
            'saisons' => $saisons
        ]);
    }


    /**
     * Le controller pour gérer la page de la liste des équipes selon une saison particulière
     * 
     * @Route("/saison/{id}", name="une_saison")
     */
    public function uneSaison(SaisonRepository $repo, EquipeRepository $repoEquipe, $id)
    {
        /**
         * @var \App\Entity\Saison|null $uneSaison 
         */
        $uneSaison = $repo->find($id);

        /**
         * @var \App\Entity\Equipe[] $equipes
         */
        $equipes = $repoEquipe->findAll();

        /**
         * @var \App\Entity\Saison[] $saisons
         */
        $saisons = $repo->findAll();

        /**
         * On veut afficher les équipes de chaque saison
         * 
         * @var array $arrayEquipe
         */
        $arrayEquipe = array();

        foreach ($equipes as &$equipe) {
            $equipeSaison = $equipe->getSaison();

            foreach ($equipeSaison as $saison) {
                if ($saison == $uneSaison) {
                    //$equipe = $equipe;
                    array_push($arrayEquipe, $equipe);
                }
            }
        }

        return $this->render('site/saison/uneSaison.html.twig', [
            'saisons' => $saisons,
            'uneSaison' => $uneSaison,
            'equipes' => $arrayEquipe,
        ]);
    }
}
