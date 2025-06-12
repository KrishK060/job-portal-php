<?php

namespace App\Controller;

use App\Repository\ApplicationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecruiterController extends AbstractController
{
    /**
     * @Route("/recruiter", name="app_recruiter")
     */
    public function index(ApplicationsRepository $applicationsRepository): Response
    {
        $appliedApplications = $applicationsRepository->findAll();

        return $this->render('recruiter/index.html.twig', [
            'applications' => $appliedApplications
        ]);
    }
}
