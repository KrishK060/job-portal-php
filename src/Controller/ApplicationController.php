<?php

namespace App\Controller;

use App\Entity\Applications;
use App\Repository\ApplicationsRepository;
use App\Repository\JobPostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends BaseController
{
    /**
     * @Route("/application", name="app_application")
     */
    public function index(): Response
    {
        return $this->render('application/index.html.twig');
    }

    /**
     * @Route("/application/{id}/accept", name="app_application_accept")
     */
    public function acceptApplication(Applications $application,EntityManagerInterface $entity){
        $application->setStatus('Shortlisted');
        $entity->flush();

         return $this->redirectToRoute('app_recruiter');
    }

    /**
     * @Route("/application/{id}/reject", name="app_application_reject")
     */
    public function rejectApplication(Applications $application,EntityManagerInterface $entity){
        $application->setStatus('Reject');
        $entity->flush();

         return $this->redirectToRoute('app_recruiter');
    }
}
