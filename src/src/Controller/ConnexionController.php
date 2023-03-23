<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AvionsRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;



class ConnexionController extends AbstractController
{
    #[Route('/', name: 'app_connexion')]
    public function index(Request $request, AvionsRepository $avrp): Response
    {


        return $this->render('connexion/index.html.twig', []);
    }
}
