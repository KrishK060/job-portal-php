<?php

namespace App\Controller;

use App\Entity\Applications;
use App\Entity\JobPost;
use App\Form\JobPostType;
use App\Repository\ApplicationsRepository;
use App\Repository\JobPostRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Schema\Constraint;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/job/post")
 * @method User getUser()
 */
class JobPostController extends AbstractController
{
    /**
     * @Route("/", name="app_job_post_index", methods={"GET"})
     */
    public function index(JobPostRepository $jobPostRepository): Response
    {   
        $jobPost = $this->getUser()->getRecruiter()->getJobPosts();
        // dd($jobPost);
       return $this->render('job_post/index.html.twig', [
            'job_posts' => $jobPost,
        ]);
    }

    /**
     * @Route("/new", name="app_job_post_new", methods={"GET", "POST"})
     */
    public function new(Request $request, JobPostRepository $jobPostRepository): Response
    {
        $jobPost = new JobPost();
        $form = $this->createForm(JobPostType::class, $jobPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobPost->setEmployer($this->getUser()->getRecruiter());
            $jobPostRepository->add($jobPost, true);

            return $this->redirectToRoute('app_job_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('job_post/new.html.twig', [
            'job_post' => $jobPost,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_job_post_show", methods={"GET"})
     */
    public function show(JobPost $jobPost): Response
    {
        return $this->render('job_post/show.html.twig', [
            'job_post' => $jobPost,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_job_post_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, JobPost $jobPost, JobPostRepository $jobPostRepository): Response
    {
        $form = $this->createForm(JobPostType::class, $jobPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobPostRepository->add($jobPost, true);

            return $this->redirectToRoute('app_job_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('job_post/edit.html.twig', [
            'job_post' => $jobPost,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_job_post_delete", methods={"POST"})
     */
    public function delete(Request $request, JobPost $jobPost, JobPostRepository $jobPostRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $jobPost->getId(), $request->request->get('_token'))) {
            $jobPostRepository->remove($jobPost, true);
        }

        return $this->redirectToRoute('app_job_post_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/{id}/apply", name="app_job_post_apply", methods={"GET"})
     */
    public function apply(JobPost $jobPost,EntityManagerInterface $entityManager): Response
    {

        $application = new Applications;
        $application->setJob($jobPost);
        $application->setJobseeker($this->getUser()->getJobSeekerProfile());
        $application->setAppliedAt(new DateTimeImmutable());
        // $application->setStatus('Applied');      
        
        $entityManager->persist($application);
        $entityManager->flush();

        return $this->redirectToRoute('app_application');
    }
}
