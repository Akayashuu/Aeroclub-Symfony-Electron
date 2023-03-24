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
use App\Logic\DatabaseLogic;
use App\Form\ApplicationConfigFormType;


class ConnexionController extends AbstractController
{
    #[Route('/', name: 'app_connexion')]
    public function index(Request $request, AvionsRepository $avrp): Response
    {
        if(DatabaseLogic::isConnected($avrp)) {
            $form = $this->createForm(ApplicationConfigFormType::class);
            return $this->render('config/config.html.twig', [
                'form' => $form->createView()
            ]);
        }
        return $this->render('connexion/index.html.twig', []);
    }
}
