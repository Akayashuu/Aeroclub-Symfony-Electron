<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AvionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_login')]
    public function index(Request $request, EntityManagerInterface $em, AvionsRepository $repo): Response
    {
        return $this->render('login/index.html.twig', []);
    }

    #[Route('/test', name: 'app_test')]
    public function test(Request $request, EntityManagerInterface $em, AvionsRepository $repo): Response
    {
        return $this->render('test/accueil.html.twig', []);
    }

}
