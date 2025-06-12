<?php

namespace App\Controller;

use App\Entity\Applications;
use App\Form\ApplicationsType;
use App\Repository\ApplicationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/abc")
 */
class AbcController extends AbstractController
{
    /**
     * @Route("/", name="app_abc_index", methods={"GET"})
     */
    public function index(ApplicationsRepository $applicationsRepository): Response
    {
        return $this->render('abc/index.html.twig', [
            'applications' => $applicationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_abc_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ApplicationsRepository $applicationsRepository): Response
    {
        $application = new Applications();
        $form = $this->createForm(ApplicationsType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $applicationsRepository->add($application, true);

            return $this->redirectToRoute('app_abc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('abc/new.html.twig', [
            'application' => $application,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_abc_show", methods={"GET"})
     */
    public function show(Applications $application): Response
    {
        return $this->render('abc/show.html.twig', [
            'application' => $application,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_abc_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Applications $application, ApplicationsRepository $applicationsRepository): Response
    {
        $form = $this->createForm(ApplicationsType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $applicationsRepository->add($application, true);

            return $this->redirectToRoute('app_abc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('abc/edit.html.twig', [
            'application' => $application,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_abc_delete", methods={"POST"})
     */
    public function delete(Request $request, Applications $application, ApplicationsRepository $applicationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$application->getId(), $request->request->get('_token'))) {
            $applicationsRepository->remove($application, true);
        }

        return $this->redirectToRoute('app_abc_index', [], Response::HTTP_SEE_OTHER);
    }
}
