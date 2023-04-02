<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_reservation')]
class ReservationController extends AbstractController
{
    #[Route('', name: 'app_reservation__camp_not_found')]
    public function campNotFound(): Response
    {
        return $this->render('reservation/campNotFound.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }
}
