<?php

namespace App\Controller;

use App\CampReservationSystem\CampId;
use App\CampReservationSystem\CampReservationSystemModule;
use App\Utility\UidHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/', name: 'app_reservation')]
class ReservationController extends AbstractController
{
    #[Route('', name: '__camp_not_found')]
    public function campNotFound(): Response
    {
        return $this->render('reservation/campNotFound.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    #[Route('{campId}', name: '__form', requirements: ['campId'=>CampId::VALIDATION_REGEX])]
    public function form(string $campId, CampReservationSystemModule $system, TranslatorInterface $translator)
    {
        $camp = $system->findCamp(new CampId($campId));
        if (!$camp){
            $this->addFlash(
                'error',
                $translator->trans('Invalid URL')
            );
            return $this->redirectToRoute('app_reservation__camp_not_found');
        }
        return $this->render('reservation/form.html.twig',[
            'camp'=>$camp
        ]);
    }
}
