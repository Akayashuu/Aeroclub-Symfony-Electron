<?php

namespace App\Controller;

use App\Form\InsertPiecesType;
use App\Repository\MaintenancePiecesRepository;
use App\Repository\PermissionsRepository;
use App\Security\CustomAuth;
use App\Security\PermissionsEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaintenanceController extends AbstractController
{
    #[Route('/maintenance', name: 'app_maintenance')]
    public function index(Request $request, PermissionsRepository $permissionsRepository, MaintenancePiecesRepository $maintenancePiecesRepository): Response
    {
        if(!CustomAuth::isConnected($request)) {return $this->redirectToRoute('app_connexion');}
        if($v = !CustomAuth::hasPermission($this, [PermissionsEnum::READ], $request, $permissionsRepository)) {return $this->redirectToRoute(PermissionsEnum::REDIRECT_ROUTE);}
        $pieces =  $maintenancePiecesRepository->findAll();
        return $this->render('maintenance/index.html.twig', [
            "pieces" => $pieces,
            "isAdmin" => $v
        ]);
    }

    #[Route('/maintenance/insert', name: 'app_maintenance_insert')]
    public function insert(Request $request, PermissionsRepository $permissionsRepository, MaintenancePiecesRepository $maintenancePiecesRepository, EntityManagerInterface $em): Response
    {
        if($v = !CustomAuth::hasPermission($this, [PermissionsEnum::WRITE], $request, $permissionsRepository)) {return $this->redirectToRoute(PermissionsEnum::REDIRECT_ROUTE);}
        if(CustomAuth::isConnected($request)) {
            $form = $this->createForm(InsertPiecesType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                            // Récupérer le fichier image
                $image = $form->get('image')->getData();

                // Déplacer le fichier image vers le dossier d'upload
                if ($image) {
                    $newFilename = uniqid().'.'.$image->guessExtension();
                    $image->move(
                        "../public/images/",
                        $newFilename
                    );
                    $registration->setImage($newFilename);
                }
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_maintenance');
            }
            return $this->render('maintenance/insert_piece.html.twig', [
                "form" => $form,
                "isAdmin" => $v
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/editPieces/{id}', name: 'pieces_edit')]
    public function editPieces(Request $request, PermissionsRepository $permissionsRepository, MaintenancePiecesRepository $maintenancePiecesRepository, EntityManagerInterface $em, $id): Response
    {
        if($v = !CustomAuth::hasPermission($this, [PermissionsEnum::UPDATE], $request, $permissionsRepository)) {return $this->redirectToRoute(PermissionsEnum::REDIRECT_ROUTE);}
        if(CustomAuth::isConnected($request)) {
            $avions = $maintenancePiecesRepository->findOneBy(["id" => $id]);
            $avions->setImage(null);
            $form = $this->createForm(InsertPiecesType::class, $avions);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_maintenance');
            }
            return $this->render('maintenance/edit_pieces.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/gestion/deletePieces/{id}', name: 'pieces_delete')]
    public function deletePieces(Request $request, PermissionsRepository $permissionsRepository, MaintenancePiecesRepository $maintenancePiecesRepository, EntityManagerInterface $em, $id): Response
    {
        if($v = !CustomAuth::hasPermission($this, [PermissionsEnum::DELETE], $request, $permissionsRepository)) {return $this->redirectToRoute(PermissionsEnum::REDIRECT_ROUTE);}
        if(CustomAuth::isConnected($request)) {
            $Avions = $maintenancePiecesRepository->findOneBy(["id" => $id]);
            if($Avions || $id != null) {
                $em->remove($Avions);
                $em->flush();
                return new JsonResponse(array('success' => true));
            } else {
                return new JsonResponse(array('success' => false));
            }
        } else {
            return new JsonResponse(array('success' => false));
        }
    }
}