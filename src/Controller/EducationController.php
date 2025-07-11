<?php

namespace App\Controller;

use App\Entity\Education;
use App\Form\EducationType;
use App\Repository\EducationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/education")
 * @method User getUser()
 */
class EducationController extends BaseController
{
 /**
 * @Route("/", name="app_education_index", methods={"GET"})
 */
public function index(EducationRepository $educationRepository): Response
{
    $jobSeekerProfile = $this->getUser()->getJobSeekerProfile();
    $educationList = $jobSeekerProfile->getEducation(); 

    return $this->render('education/index.html.twig', [
        'education' => $educationList
    ]);
}


    /**
     * @Route("/new", name="app_education_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EducationRepository $educationRepository): Response
    {
        $education = new Education();
        $form = $this->createForm(EducationType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $education->setProfile($this->getUser()->getJobSeekerProfile());
            
            $educationRepository->add($education, true);

            return $this->redirectToRoute('app_education_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('education/new.html.twig', [
            'education' => $education,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_education_show", methods={"GET"})
     */
    public function show(Education $education): Response
    {
        return $this->render('education/show.html.twig', [
            'education' => $education,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_education_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Education $education, EducationRepository $educationRepository): Response
    {
        $form = $this->createForm(EducationType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $educationRepository->add($education, true);

            return $this->redirectToRoute('app_education_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('education/edit.html.twig', [
            'education' => $education,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_education_delete", methods={"POST"})
     */
    public function delete(Request $request, Education $education, EducationRepository $educationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$education->getId(), $request->request->get('_token'))) {
            $educationRepository->remove($education, true);
        }

        return $this->redirectToRoute('app_education_index', [], Response::HTTP_SEE_OTHER);
    }
}
