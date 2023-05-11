<?php

namespace App\Controller;

use App\Entity\Membres;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Logic\DatabaseLogic;
use App\Form\ApplicationConfigFormType;
use App\Form\EmailFormType;
use App\Form\LoginFormType;
use App\Repository\MembresRepository;
use App\Security\CustomAuth;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\EnvManager;
use DateTime;

class ConnexionController extends AbstractController
{
    #[Route('/pass/${email}', name: 'app_connexion_pass')]
    public function passwordVerify(Request $request, ManagerRegistry $em, MembresRepository $membresRepository, EntityManagerInterface $emv, $email): Response
    {
        if(CustomAuth::isConnected($request)){return $this->redirectToRoute('app_accueil');}
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
                if($v == true) {EnvManager::updateEnv($result["adresseIp"], 5432, $result["utilisateur"], $result["motdepasse"], $result["database"]);}
                return $this->redirectToRoute('app_connexion');
            }
            return $this->render('config/config.html.twig', ['form' => $form->createView()]);
        } else {
            $form = $this->createForm(LoginFormType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $result = $form->getData();
                $authLogic = new CustomAuth($result["password"],  $email, $membresRepository, $request);
                $data = $authLogic->getMembresData();
                $banned = false;
                if($data != null ) {
                    if( $data["banTime"] != null) {
                        $newD = $data["banTime"]->modify("5 minutes") ;
                        $banned = ($newD) > new DateTime();
                    }
                } else {
                    // ban IP
                }
                if($authLogic->authentification() && $banned == false) {
                    $authLogic->loadAuthentication();
                } else {
                        if($data == null) {
                            $this->addFlash('notice', "Erreur ! Votre mot de passe est incorrect.");
                            return $this->redirectToRoute('app_connexion');
                        } else {
                            $k = $membresRepository->findBy(['email' => $email])[0];
                            $restett = 3 - $data["nbTentatives"];
                            if($restett <= 0 || $banned == true) {
                                $msg = "Vous etes bannis pendant 5 minutes.";
                                if($banned == false) {$k->setBanTime(new DateTime());}
                            } else {
                                $nv = $data["nbTentatives"]+1;
                                $k->setNbTentatives($nv);
                                $msg = "Nombre de tentative restante : $restett";
                            }
                            if($banned == false && $data["nbTentatives"] == 3) {
                                $k->setNbTentatives(0);
                                $k->setBanTime(null);
                            }
                            $emv->persist($k);
                            $emv->flush();
                            $this->addFlash('notice', "Erreur ! Votre mot de passe est incorrect.".$msg);
                            return $this->redirectToRoute('app_connexion_pass', ["email"=> $email]);
                        }
                }
            }
            return $this->render('connexion/passwordcon.html.twig', ['form' => $form->createView()]);
        }
    }

    #[Route('/', name: 'app_connexion')]
    public function index(Request $request, ManagerRegistry $em, MembresRepository $membresRepository): Response
    {
        if(CustomAuth::isConnected($request)){return $this->redirectToRoute('app_accueil');}
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
            $form = $this->createForm(EmailFormType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $result = $form->getData();
                return $this->redirectToRoute('app_connexion_pass', ["email"=> $result["email"]]);
            }
            return $this->render('connexion/mailcon.html.twig', ['form' => $form->createView()]);
        }
    }
}
