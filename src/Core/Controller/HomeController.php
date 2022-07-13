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
        return $this->render('Home/home.html.twig');

    }

}
