<?php

namespace App\Core\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;

class HomeController extends AbstractController
{
    /**
     *  @Route ("/home", name="home")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user=$this->getUser();

        $emailGet = $user->getEmail();

        return $this->render('Home/home.twig', ['emailGet'=>$emailGet]);
    }

    /**
     *  @Route ("/admin", name="admin")
     */
    public function adminUsers()
    {
        $user=$this->getUser();

        $emailGet = $user->getEmail();

        return $this->render('Home/home.twig', ['emailGet'=>$emailGet]);
    }
}
