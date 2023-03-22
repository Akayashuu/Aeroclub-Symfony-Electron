<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AvionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ConnexionController extends AbstractController
{
    #[Route('/', name: 'app_connexion')]
    public function index(): Response
    {
        return $this->render('connexion/index.html.twig', []);
    }
}
