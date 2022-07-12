<?php

namespace App\Core\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;

class DashboardController extends AbstractController
{
    /**
     *  @Route ("/user/dashboard", name="dashboard")
     */
    public function index()
    {
        $user = new User();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user=$this->getUser();
        $emailGet = $user->getEmail();
        return $this->render('User/dashboard.twig', ['emailGet'=>$emailGet]);

    }

    /**
     *  @Route ("/user/admin_dashboard", name="admin_dashboard")
     */
    public function adminUsers()
    {
        $user=$this->getUser();

        $emailGet = $user->getEmail();

        return $this->render('User/dashboard.twig', ['emailGet'=>$emailGet]);
    }
}
