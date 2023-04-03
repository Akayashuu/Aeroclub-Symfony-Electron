<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Logic\DatabaseLogic;
use App\Form\ApplicationConfigFormType;
use App\Form\LoginFormType;
use App\Repository\MembresRepository;
use App\Security\CustomAuth;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\EnvManager;


class ConnexionController extends AbstractController
{
    #[Route('/', name: 'app_connexion')]
    public function index(Request $request, ManagerRegistry $em, MembresRepository $membresRepository): Response
    {
        if(CustomAuth::isConnected($request)){
            return $this->redirectToRoute('app_accueil');
        }
        if(DatabaseLogic::envCheck() || DatabaseLogic::isConnected($em)) {
            $form = $this->createForm(ApplicationConfigFormType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $msg = "";
                $v = true;
                $result = $form->getData();
                if(!filter_var($result["adresseIp"], FILTER_VALIDATE_IP)) {$msg .= "\nAdresse Ip invalide !";$v = $v = false;}   
                if($v == false) {$this->addFlash('notice', $msg);}
                if($v == true) {
                    EnvManager::updateEnv($result["adresseIp"], 5432, $result["utilisateur"], $result["motdepasse"], $result["database"]);
                }
                return $this->redirectToRoute('app_connexion');
            }
            return $this->render('config/config.html.twig', ['form' => $form->createView()]);
        } else {
            $form = $this->createForm(LoginFormType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $result = $form->getData();
                $authLogic = new CustomAuth($result["password"], $result["email"], $membresRepository, $request);
                if($authLogic->authentification()) {
                    return $authLogic->loadAuthentication();
                } else {
                    $this->addFlash('notice', "Erreur ! Votre mot de passe est incorrect.");
                    return $this->redirectToRoute('app_connexion');
                }
            }
            return $this->render('connexion/index.html.twig', ['form' => $form->createView()]);
        }
    }
}
