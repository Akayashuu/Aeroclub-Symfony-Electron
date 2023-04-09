<?php

namespace App\Controller;

use App\Repository\ComptesAcRepository;
use App\Repository\MembresRepository;
use App\Security\CustomAuth;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, MembresRepository $membresRepository, ComptesAcRepository $comptesAcRepository): Response
    {
        if(CustomAuth::isConnected($request)) {
            $session = $request->getSession();
            $memberId = $session->get("userid");
            $Member = $membresRepository->findOneBy(["numMembres" => $memberId]);
            $CompteAc = $comptesAcRepository->findAll(["numMembres" => $memberId]);
            return $this->render('profile/index.html.twig', [
                "membre" => $Member,
                "compte" => $CompteAc
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }
}
