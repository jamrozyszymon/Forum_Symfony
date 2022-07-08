<?php

namespace App\Core\Controller;

use App\Core\CreatePost;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

class PostController extends AbstractController
{
    /**
     *  @Route ("/post", name="post")
     */
    public function create(CreatePost $createPost, Request $request, EntityManagerInterface $entityManagerInterface)
    {
        $user = new User();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user=$this->getUser();
        if($request->isMethod('POST')) {
            try{
                $createPost->create($request->get('content'), $user);
                $this->addFlash('success', "Post został dodany");
            } catch (Exception $ex) {
                $this->addFlash('danger', $ex->getMessage());
            }
        }
        return $this->render('Post/post.twig');
    }
    
}
