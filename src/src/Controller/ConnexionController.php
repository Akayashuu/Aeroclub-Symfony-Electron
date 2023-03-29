<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Logic\DatabaseLogic;
use App\Form\ApplicationConfigFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class ConnexionController extends AbstractController
{
    #[Route('/', name: 'app_connexion')]
    public function index(Request $request, ManagerRegistry $em): Response
    {

        if(DatabaseLogic::envCheck() || DatabaseLogic::isConnected($em)) {
            $form = $this->createForm(ApplicationConfigFormType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $result = $form->getData();

            }
            return $this->render('config/config.html.twig', ['form' => $form->createView()]);
        }
        return $this->render('connexion/index.html.twig', []);
    }

    #[Route('/test', name: 'app_test')]
    public function test(Request $request, ManagerRegistry $em): Response
    {
        return $this->render('test/accueil.html.twig', []);
    }
}
