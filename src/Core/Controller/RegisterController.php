<?php

namespace App\Core\Controller;

use Symfony\Component\HttpFoundation\Request;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Core\Services\RegisterUser;


class RegisterController extends AbstractController
{
    /**
    *  @Route("/user/register", name="register")
    */
    public function register(Request $request, RegisterUser $registerUser)
    {
        if($request->isMethod('Post')) {
            try {
                $registerUser->registerFromRequest($request);
                return $this->render('User/registration.html.twig');
                $this->addFlash('success', 'Udana rejestracja');
            } catch (Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }
        return $this->render('User/registration.html.twig');
    }

}
