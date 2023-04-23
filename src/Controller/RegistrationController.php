<?php

namespace App\Controller;

use App\CampRegistrationSystem\CampId;
use App\CampRegistrationSystem\CampRegistrationSystemModule;
use App\CampRegistrationSystem\RegistrationData;
use App\CampRegistrationSystem\Registration;
use App\Form\RegistrationForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_registration')]
class RegistrationController extends AbstractController
{
    #[Route('', name: '__camp_not_found')]
    public function campNotFound(): Response
    {
        return $this->render('registration/campNotFound.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }


    #[Route('error', name: '__system_unavailable')]
    public function systemUnavailable(): Response
    {
        return $this->render('registration/systemUnavailable.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }

    #[Route('success', name: '__success')]
    public function success(): Response
    {
        return $this->render('registration/success.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }

    #[Route('{campId}', name: '__form', requirements: ['campId'=>CampId::VALIDATION_REGEX])]
    public function form(
        string $campId,
        Request $request,
        CampRegistrationSystemModule $system
    ) {
        $camp = $system->findCamp(new CampId($campId));
        if (!$camp) {
            $this->addFlash(
                'error',
                'Invalid URL'
            );
            return $this->redirectToRoute('app_registration__camp_not_found');
        }

        $form = $this->createForm(RegistrationForm::class, new RegistrationData($camp), ['camp'=>$camp]);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data = $form->getData();
                $state = $system->register($data);
                if (!$state) {
                    return $this->redirectToRoute('app_registration__system_unavailable');
                }
                return $this->redirectToRoute('app_registration__success');
            } else {
                $this->addFlash(
                    'error',
                    'Invalid Form'
                );
            }
        }
        return $this->render('registration/form.html.twig', [
            'camp'=>$camp,
            'form'=>$form
        ]);
    }
}
