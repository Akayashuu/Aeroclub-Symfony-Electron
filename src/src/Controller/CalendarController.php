<?php

namespace App\Controller;

use App\Repository\PermissionsRepository;
use App\Repository\ReservationRepository;
use App\Security\CustomAuth;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ReservationFormType;
class CalendarController extends AbstractController
{
    #[Route('/calendar', name: 'app_calendar')]
    public function index(): Response
    {
        return $this->render('calendar/index.html.twig', []);
    }


    #[Route('/calendar/show', name: 'app_show_calendar')]
    public function showAvions(Request $request, ReservationRepository $reservationRepository, PermissionsRepository $permissionsRepository): Response
    {
        if(CustomAuth::isConnected($request)) {
            $reservationData = $reservationRepository->findAll();
            return $this->render('calendar/show_reservation.html.twig', [
                "reservation" => $reservationData,
                "isAdmin" =>CustomAuth::isAdmin($request, $permissionsRepository)
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/calendar/insertReservation', name: 'app_insert_calendar')]
    public function createAvions(Request $request, ReservationRepository $reservationRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $form = $this->createForm(ReservationFormType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $k = $reservationRepository->checkAvionReservationConflict($registration->getScheduledAt(), $registration->getEndAt(), $registration->getnumavions()->getNumAvions());
                $k2 = $reservationRepository->checkMembreReservationConflict($registration->getScheduledAt(), $registration->getEndAt(), $registration->getNumMembres()->getNumMembres());
                if($k || $k2) {
                    $this->addFlash('notice', "La réservation pour cet avion/membre n'a pas pu être créée car il y a un conflit de réservation pendant la période choisie."); 
                    return $this->redirectToRoute('app_show_calendar');
                } else {
                    $em ->persist($registration);
                    $em->flush();
                    return $this->redirectToRoute('app_show_calendar');
                }
            }
            return $this->render('calendar/insertReservation.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/calendar/editReservation/{id}', name: 'app_edit_calendar')]
    public function editReservation(Request $request, ReservationRepository $reservationRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $em, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $avions = $reservationRepository->findOneBy(["id" => $id]);
            $form = $this->createForm(ReservationFormType::class, $avions);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $registration = $form->getData();
                $em ->persist($registration);
                $em->flush();
                return $this->redirectToRoute('app_show_calendar');
            }
            return $this->render('calendar/editReservation.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('app_connexion');
        }
    }

    #[Route('/calendar/deleteReservation/{id}', name: 'app_delete_calendar')]
    public function deleteReservation(Request $request, ReservationRepository $reservationRepository, PermissionsRepository $permissionsRepository, EntityManagerInterface $entityManager, $id): Response
    {
        if(CustomAuth::isConnected($request) && CustomAuth::isAdmin($request, $permissionsRepository)) {
            $Avions = $reservationRepository->findOneBy(["id" => $id]);
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

