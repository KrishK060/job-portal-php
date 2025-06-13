<?php

namespace App\Controller;

use App\Entity\Recruiter;
use App\Form\RecruiterType;
use App\Repository\RecruiterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recruiter/profile")

 */
class RecruiterProfileController extends BaseController
{
    /**
     * @Route("/", name="app_recruiter_profile_index", methods={"GET"})
     */
    public function index(RecruiterRepository $recruiterRepository): Response
    {
        $RecruiterProfile = $this->getUser()->getRecruiter();
        return $this->render('recruiter_profile/index.html.twig', [
            'recruiters' => [$RecruiterProfile]
        ]);
    }

    /**
     * @Route("/new", name="app_recruiter_profile_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RecruiterRepository $recruiterRepository): Response
    {
        $recruiter = new Recruiter();
        $form = $this->createForm(RecruiterType::class, $recruiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recruiter->setUser($this->getUser());

            $recruiterRepository->add($recruiter, true);

            return $this->redirectToRoute('app_recruiter_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recruiter_profile/new.html.twig', [
            'recruiter' => $recruiter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_recruiter_profile_show", methods={"GET"})
     */
    public function show(Recruiter $recruiter): Response
    {
        return $this->render('recruiter_profile/show.html.twig', [
            'recruiter' => $recruiter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_recruiter_profile_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Recruiter $recruiter, RecruiterRepository $recruiterRepository): Response
    {
        $form = $this->createForm(RecruiterType::class, $recruiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recruiterRepository->add($recruiter, true);

            return $this->redirectToRoute('app_recruiter_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recruiter_profile/edit.html.twig', [
            'recruiter' => $recruiter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_recruiter_profile_delete", methods={"POST"})
     */
    public function delete(Request $request, Recruiter $recruiter, RecruiterRepository $recruiterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recruiter->getId(), $request->request->get('_token'))) {
            $recruiterRepository->remove($recruiter, true);
        }

        return $this->redirectToRoute('app_recruiter_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
