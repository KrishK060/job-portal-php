<?php

namespace App\Controller;

use App\Entity\Applications;
use App\Message\OnRejectSendEmail;
use App\Message\OnShortlistSendEmail;
use App\Repository\ApplicationsRepository;
use App\Repository\JobPostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends BaseController
{
    /**
     * @Route("/application", name="app_application")
     */
    public function index(Applications $applications): Response
    {

        // dd($user);
        return $this->render('application/index.html.twig');
    }

    /**
     * @Route("/application/{id}/accept", name="app_application_accept")
     */
    public function acceptApplication(Applications $application, EntityManagerInterface $entity,MessageBusInterface $messageBus)
    {
        $application->setStatus('Shortlisted');
        $entity->flush();
        $messageBus->dispatch(new OnShortlistSendEmail($application->getJobseeker()->getUser()->getEmail()));

        return $this->redirectToRoute('app_recruiter');
    }

    /**
     * @Route("/application/{id}/reject", name="app_application_reject")
     */
    public function rejectApplication(Applications $application, EntityManagerInterface $entity, MessageBusInterface $messageBus)
    {

        $application->setStatus('Reject');
        $entity->flush();
        $messageBus->dispatch(new OnRejectSendEmail($application->getJobseeker()->getUser()->getEmail()));

        return $this->redirectToRoute('app_recruiter');
    }
}
