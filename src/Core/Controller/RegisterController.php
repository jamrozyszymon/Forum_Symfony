<?php

namespace App\Core\Controller;

use Symfony\Component\HttpFoundation\Request;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Core\RegisterUser;


class RegisterController extends AbstractController
{
    /**
    *  @Route("/signup", name="signup")
    */
    public function signUp(Request $request, RegisterUser $registerUser)
    {
        if($request->isMethod('Post')) {
            try {
                $registerUser->registerFromRequest($request);
                $this->addFlash('success', 'Udana rejestracja');
            } catch (Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }
        return $this->render('User/registration.twig');
    }

}
