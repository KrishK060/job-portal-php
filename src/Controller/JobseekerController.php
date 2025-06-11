<?php

namespace App\Controller;

use App\Repository\JobPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobseekerController extends AbstractController
{
    /**
     * @Route("/jobseeker", name="app_jobseeker")
     */
    public function index(JobPostRepository $jobPostRepository): Response
    {
        return $this->render('jobseeker/index.html.twig', [
            'controller_name' => 'JobseekerController',
            'jobs' => $jobPostRepository->findAll()
        ]);
    }
}
