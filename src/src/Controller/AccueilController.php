<?php

namespace App\Controller;

use App\Security\CustomAuth;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(Request $request): Response
    {
        if(CustomAuth::isConnected($request)) {
            return $this->render('accueil/index.html.twig', []);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }
}
