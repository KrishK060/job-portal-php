<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController{
     /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
       
        return $this->render('/loginpage.html.twig',[
            "error" => $authenticationUtils->getLastAuthenticationError(),
            "lastUserName" => $authenticationUtils->getLastUsername()
        ]);
    }
    
     /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This should never be reached');
    }
}