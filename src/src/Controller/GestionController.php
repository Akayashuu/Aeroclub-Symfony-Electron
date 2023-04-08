<?php

namespace App\Controller;

use App\Entity\Avions;
use App\Entity\Membres;
use App\Entity\Instructeurs;
use App\Form\InsertAvionsFormType;
use App\Form\InsertMembresFormType;
use App\Form\InsertInstrucType;
use App\Form\InsertBadgeType;
use App\Form\InsertMotifType;
use App\Form\InsertQualifType;
use App\Repository\AvionsRepository;
use App\Repository\BadgeRepository;
use App\Repository\MembresRepository;
use App\Repository\InstructeursRepository;
use App\Repository\MotifsRepository;
use App\Repository\PermissionsRepository;
use App\Repository\QualifRepository;
use App\Security\CustomAuth;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function showAvions(Request $request, AvionsRepository $avionsRepository, PermissionsRepository $permissionsRepository): Response
    {
        if(CustomAuth::isConnected($request)) {
            $avionsData = $avionsRepository->findAll();
            return $this->render('gestion/avions/show_avions.html.twig', [
                "avions" => $avionsData,
                "isAdmin" =>CustomAuth::isAdmin($request, $permissionsRepository)
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/insertAvions', name: 'avion_create')]
    public function createAvions(Request $request, AvionsRepository $avionsRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $form = $this->createForm(InsertAvionsFormType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_avions');
            }
            return $this->render('gestion/avions/insert_avions.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/editAvions/{id}', name: 'avion_edit')]
    public function editAvions(Request $request, AvionsRepository $avionsRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $avions = $avionsRepository->findOneBy(["numAvions" => $id]);
            $form = $this->createForm(InsertAvionsFormType::class, $avions);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_avions');
            }
            return $this->render('gestion/avions/edit_avions.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/deleteAvions/{id}', name: 'avion_delete')]
    public function deleteAvions(Request $request, AvionsRepository $avionsRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $entityManager, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $Avions = $avionsRepository->findOneBy(["numAvions" => $id]);
            if($Avions || $id != null) {
                $entityManager->remove($Avions);
                $entityManager->flush();
                return new JsonResponse(array('success' => true));
            } else {
                return new JsonResponse(array('success' => false));
            }
        } else {
            return new JsonResponse(array('success' => false));
        }
    }

    #[Route('/gestion/instructeurs', name: 'app_show_instructeur')]
    public function showInstructeur(Request $request, InstructeursRepository $InstructeursRepository, PermissionsRepository $permissionsRepository): Response
    {
        if(CustomAuth::isConnected($request)) {
            $instructeursData = $InstructeursRepository->findAll();
            return $this->render('gestion/instructeur/show_instructeurs.html.twig', [
                "instructeurs" => $instructeursData,
                "isAdmin" =>CustomAuth::isAdmin($request, $permissionsRepository)
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/insertInstruc', name: 'instruc_create')]
    public function createInstruc(Request $request, InstructeursRepository $InstructeursRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $form = $this->createForm(InsertInstrucType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_instructeur');
            }
            return $this->render('gestion/instructeur/insert_instruc.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }
    
    #[Route('/gestion/editInstructeurs/{id}', name: 'instructeur_edit')]
    public function editInstructeurs(Request $request, InstructeursRepository $instructeursRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $instructeurs = $instructeursRepository->findOneBy(["numInstructeur" => $id]);
            $form = $this->createForm(InsertInstrucType::class, $instructeurs);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_instructeur');
            }
            return $this->render('gestion/instructeur/edit_instructeurs.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/deleteInstruc/{id}', name: 'instruc_delete')]
    public function deleteInstruc(Request $request, InstructeursRepository $instructeursRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $entityManager, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $Instructeurs = $instructeursRepository->findOneBy(["numInstructeur" => $id]);
            if($Instructeurs || $id != null) {
                $entityManager->remove($Instructeurs);
                $entityManager->flush();
                return new JsonResponse(array('success' => true));
            } else {
                return new JsonResponse(array('success' => false));
            }
        } else {
            return new JsonResponse(array('success' => false));
        }
    }

    #[Route('/gestion/membres', name: 'app_show_membres')]
    public function showMembres(Request $request, MembresRepository $membresRepository, PermissionsRepository $permissionsRepository): Response
    {
        if(CustomAuth::isConnected($request)) {
            $membresData = $membresRepository->findAll();
            return $this->render('gestion/membres/show_membres.html.twig', [
                "membres" => $membresData,
                "isAdmin" =>CustomAuth::isAdmin($request, $permissionsRepository)
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }


    #[Route('/gestion/insertMembres', name: 'membres_create')]
    public function createMembres(Request $request, MembresRepository $membresRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $form = $this->createForm(InsertMembresFormType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $registration->setPassword(password_hash($registration->getPassword(), PASSWORD_DEFAULT));
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_membres');
            }
            return $this->render('gestion/membres/insert_membres.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/editMembres/{id}', name: 'membres_edit')]
    public function editMembres(Request $request, MembresRepository $membresRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
           $avions = $membresRepository->findOneBy(["numMembres" => $id]);
           $avions->setPassword("");
            $form = $this->createForm(InsertMembresFormType::class, $avions);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $registration->setPassword(password_hash($registration->getPassword(), PASSWORD_DEFAULT));
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_membres');
            }
            return $this->render('gestion/membres/edit_membres.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/deleteMembres/{id}', name: 'membres_delete')]
    public function deleteMembres(Request $request, MembresRepository $membresRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $entityManager, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $Avions = $membresRepository->findOneBy(["numMembres" => $id]);
            if($Avions || $id != null) {
                $entityManager->remove($Avions);
                $entityManager->flush();
                return new JsonResponse(array('success' => true));
            } else {
                return new JsonResponse(array('success' => false));
            }
        } else {
            return new JsonResponse(array('success' => false));
        }
    }

    #[Route('/gestion/badge', name: 'app_show_badges')]
    public function showBadges(Request $request, BadgeRepository $badgeRepository, PermissionsRepository $permissionsRepository): Response
    {
        if(CustomAuth::isConnected($request)) {
            $BadgesData = $badgeRepository->findAll();
            return $this->render('gestion/badge/show_badge.html.twig', [
                "badges" => $BadgesData,
                "isAdmin" =>CustomAuth::isAdmin($request, $permissionsRepository)
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }


    #[Route('/gestion/insertBadge', name: 'badge_create')]
    public function createBadge(Request $request, BadgeRepository $badgeRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $form = $this->createForm(InsertBadgeType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_badges');
            }
            return $this->render('gestion/badge/insert_badge.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/editBadge/{id}', name: 'badge_edit')]
    public function editBadge(Request $request, BadgeRepository $badgeRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
           $avions = $badgeRepository->findOneBy(["numBadge" => $id]);
            $form = $this->createForm(InsertBadgeType::class, $avions);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_badges');
            }
            return $this->render('gestion/badge/edit_badge.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/deleteBadges/{id}', name: 'badge_delete')]
    public function deleteBadge(Request $request, BadgeRepository $badgeRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $entityManager, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $Avions = $badgeRepository->findOneBy(["numBadge" => $id]);
            if($Avions || $id != null) {
                $entityManager->remove($Avions);
                $entityManager->flush();
                return new JsonResponse(array('success' => true));
            } else {
                return new JsonResponse(array('success' => false));
            }
        } else {
            return new JsonResponse(array('success' => false));
        }
    }

    #[Route('/gestion/qualif', name: 'app_show_qualif')]
    public function showQualif(Request $request, QualifRepository $qualifRepository, PermissionsRepository $permissionsRepository): Response
    {
        if(CustomAuth::isConnected($request)) {
            $qualifData = $qualifRepository->findAll();
            return $this->render('gestion/qualif/show_qualif.html.twig', [
                "qualif" => $qualifData,
                "isAdmin" =>CustomAuth::isAdmin($request, $permissionsRepository)
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }


    #[Route('/gestion/insertQualif', name: 'qualif_create')]
    public function createQualif(Request $request, QualifRepository $qualifRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $form = $this->createForm(InsertQualifType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_qualif');
            }
            return $this->render('gestion/qualif/insert_qualif.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/editQualif/{id}', name: 'qualif_edit')]
    public function editQualif(Request $request, QualifRepository $qualifRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
        $avions = $qualifRepository->findOneBy(["numQualif" => $id]);
            $form = $this->createForm(InsertQualifType::class, $avions);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_qualif');
            }
            return $this->render('gestion/qualif/edit_qualif.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/deleteQualif/{id}', name: 'qualif_delete')]
    public function deleteQualif(Request $request, QualifRepository $qualifRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $entityManager, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $Avions = $qualifRepository->findOneBy(["numQualif" => $id]);
            if($Avions || $id != null) {
                $entityManager->remove($Avions);
                $entityManager->flush();
                return new JsonResponse(array('success' => true));
            } else {
                return new JsonResponse(array('success' => false));
            }
        } else {
            return new JsonResponse(array('success' => false));
        }
    }


    //
    #[Route('/gestion/motif', name: 'app_show_motif')]
    public function showMotif(Request $request, MotifsRepository $motifsRepository, PermissionsRepository $permissionsRepository): Response
    {
        if(CustomAuth::isConnected($request)) {
            $qualifData = $motifsRepository->findAll();
            return $this->render('gestion/motif/show_motif.html.twig', [
                "motif" => $qualifData,
                "isAdmin" =>CustomAuth::isAdmin($request, $permissionsRepository)
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }


    #[Route('/gestion/insertMotif', name: 'motif_create')]
    public function createMotif(Request $request,  MotifsRepository $motifsRepository,PermissionsRepository $permissionsRepository, EntityManagerInterface $em): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $form = $this->createForm(InsertMotifType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_motif');
            }
            return $this->render('gestion/motif/insert_motif.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/editMotif/{id}', name: 'motif_edit')]
    public function editMotif(Request $request, MotifsRepository $motifsRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
        $avions = $motifsRepository->findOneBy(["numMotif" => $id]);
            $form = $this->createForm(InsertMotifType::class, $avions);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_motif');
            }
            return $this->render('gestion/motif/edit_motif.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/deleteMotif/{id}', name: 'motif_delete')]
    public function deleteMotif(Request $request, MotifsRepository $motifsRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $entityManager, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $Avions = $motifsRepository->findOneBy(["numMotif" => $id]);
            if($Avions || $id != null) {
                $entityManager->remove($Avions);
                $entityManager->flush();
                return new JsonResponse(array('success' => true));
            } else {
                return new JsonResponse(array('success' => false));
            }
        } else {
            return new JsonResponse(array('success' => false));
        }
    }

}
