<?php

namespace App\Core\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    /**
     *  @Route ("/user/create")
     */
    public function createUser(UserPasswordHasherInterface $userPasswordHasherInterface, EntityManagerInterface $entityManagerInterface)
    {
        $user = new User();
        $user->setname('testt');
        $user->setEmail('test@test2.com');   
        $hashedPassword = $userPasswordHasherInterface->hashPassword($user, 'Test123');
        $user->setPassword($hashedPassword);
        $entityManagerInterface->persist($user);
        $entityManagerInterface->flush();
        die();
        

    }
}
