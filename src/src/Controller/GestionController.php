<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionController extends AbstractController
{
    #[Route('/gestion', name: 'app_gestion')]
    public function index(): Response
    {
        return $this->render('gestion/gestion.html.twig', []);
    }

    #[Route('/gestion/avions', name: 'app_show_avions')]
    public function showAvions(): Response
    {
        return $this->render('gestion/show_avions.html.twig', []);
    }
}
