<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ApplicationsRepository;
use App\Repository\JobPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobseekerController extends BaseController
{
    /**
     * @Route("/jobseeker", name="app_jobseeker")
    *  @method User getUser()
    */
    public function index(JobPostRepository $jobPostRepository,ApplicationsRepository $applicationsRepository): Response
    {
        $applications = $applicationsRepository->findBy([
            'jobseeker' => $this->getUser()->getJobSeekerProfile(),
            'status' => ['Applied', 'Shortlisted', 'Reject'] 
        ]);
        
        $appliedJobs = [];
        foreach ($applications as $application) {
            $appliedJobs[] = $application->getJob()->getId();
        }
        // dd($appliedJobs);
        
        return $this->render('jobseeker/index.html.twig', [
            'controller_name' => 'JobseekerController',
            'jobs' => $jobPostRepository->findAll(),
            'appliedJobs' => $appliedJobs
        ]);
    }
}
