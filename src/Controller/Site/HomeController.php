<?php

namespace App\Controller\Site;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

    /**
     * Le controller pour gérer la page d'accueil
     * 
     * @route("/", name="home")
     */
    public function home(): Response
    {

        return $this->render('site/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
