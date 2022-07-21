<?php

namespace App\Core\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Post;
use App\Form\AddPostType;

class DashboardController extends AbstractController
{
    /**
     *  @Route ("/user/dashboard", name="dashboard")
     */
    public function index()
    {
        $user = new User();
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user=$this->getUser();
        $emailGet = $user->getEmail();
        return $this->render('User/dashboard.html.twig', ['emailGet'=>$emailGet]);
        
    }

}
