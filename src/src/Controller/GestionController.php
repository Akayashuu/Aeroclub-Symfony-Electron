<?php

namespace App\Controller;

use App\Repository\AvionsRepository;
use App\Security\CustomAuth;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GestionController extends AbstractController
{
    #[Route('/gestion', name: 'app_gestion')]
    public function index(Request $request): Response
    {
        if(CustomAuth::isConnected($request)) {
            return $this->render('gestion/gestion.html.twig', []);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/avions', name: 'app_show_avions')]
    public function showAvions(Request $request, AvionsRepository $avionsRepository): Response
    {
        if(CustomAuth::isConnected($request)) {
            $avionsData = $avionsRepository->findAll();
            return $this->render('gestion/show_avions.html.twig', [
                "avions" => $avionsData
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }
}
