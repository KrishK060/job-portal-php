<?php

namespace App\Controller;

use App\Entity\JobSeekerProfile;
use App\Form\JobSeekerProfileType;
use App\Repository\JobSeekerProfileRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/job/seeker/profile")
 */
class JobSeekerProfileController extends BaseController
{
    /**
     * @Route("/", name="app_job_seeker_profile_index", methods={"GET"})
     */
    public function index(): Response
    {
        $jobSeekerProfile = $this->getUser()->getJobSeekerProfile();
    
        return $this->render('job_seeker_profile/index.html.twig', [
            'job_seeker_profiles' => [$jobSeekerProfile]
        ]);
    }
    

    /**
     * @Route("/new", name="app_job_seeker_profile_new", methods={"GET", "POST"})
     */
    public function new(Request $request, JobSeekerProfileRepository $jobSeekerProfileRepository): Response
    {
        $jobSeekerProfile = new JobSeekerProfile();
        $form = $this->createForm(JobSeekerProfileType::class, $jobSeekerProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
    
            $jobSeekerProfile->setUser($this->getUser);
            $jobSeekerProfileRepository->add($jobSeekerProfile, true);

            return $this->redirectToRoute('app_job_seeker_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('job_seeker_profile/new.html.twig', [
            'job_seeker_profile' => $jobSeekerProfile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/profile", name="app_job_seeker_profile_show", methods={"GET"})
     */
    public function show(JobSeekerProfile $jobSeekerProfile): Response
    {
        // dd( $this->getUser()->getJobSeekerProfile());
        $jobSeekerProfile = $this->getUser()->getJobSeekerProfile();
        return $this->render('job_seeker_profile/show.html.twig', [
            'job_seeker_profile' => $jobSeekerProfile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_job_seeker_profile_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, JobSeekerProfile $jobSeekerProfile, JobSeekerProfileRepository $jobSeekerProfileRepository): Response
    {
        $form = $this->createForm(JobSeekerProfileType::class, $jobSeekerProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobSeekerProfileRepository->add($jobSeekerProfile, true);

            return $this->redirectToRoute('app_job_seeker_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('job_seeker_profile/new.html.twig', [
            'job_seeker_profile' => $jobSeekerProfile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_job_seeker_profile_delete", methods={"POST"})
     */
    public function delete(Request $request, JobSeekerProfile $jobSeekerProfile, JobSeekerProfileRepository $jobSeekerProfileRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobSeekerProfile->getId(), $request->request->get('_token'))) {
            $jobSeekerProfileRepository->remove($jobSeekerProfile, true);
        }

        return $this->redirectToRoute('app_job_seeker_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
