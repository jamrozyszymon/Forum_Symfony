<?php

namespace App\Core\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Annotations\Annotation;

class HomeController extends AbstractController
{
    /**
     *  @Route ("/test", name="test")
     */
    public function index()
    {
        return $this->render('Home/home.twig');
    }
}
