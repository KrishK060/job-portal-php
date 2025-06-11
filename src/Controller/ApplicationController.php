<?php

namespace App\Controller;

use App\Repository\JobPostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    /**
     * @Route("/application", name="app_application")
     */
    public function index(): Response
    {
        return $this->render('application/index.html.twig');
    }
}
