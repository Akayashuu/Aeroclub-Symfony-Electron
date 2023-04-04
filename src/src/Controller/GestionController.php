<?php

namespace App\Controller;

use App\Entity\Avions;
use App\Form\InsertAvionsFormType;
use App\Repository\AvionsRepository;
use App\Repository\PermissionsRepository;
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
            return $this->render('gestion/show_avions.html.twig', [
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
            return $this->render('gestion/insert_avions.html.twig', [
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
            return $this->render('gestion/edit_avions.html.twig', [
                'form' => $form->createView()
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

}
