<?php

namespace App\Core\Controller;

use App\Core\Services\CreatePost;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Post;
use Knp\Component\Pager\PaginatorInterface;


class PostController extends AbstractController
{
    /**
     *  @Route("/Post/create", name="post_create")
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
        return $this->render('Post/create.twig');
    }

    /**
     * @Route("/Post/show", name="post_show")
     */
    public function showPost(ManagerRegistry $doctrine,  PaginatorInterface $paginator, Request $request)
    {
        $posts = $doctrine->getRepository(Post::class)->findAll();
        
        $paginate = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1), 5
        );

        if (!$posts) {
            throw $this->createNotFoundException(
                'Brak postów do wyświelenia.'
            );
        }
        return $this->render('Post/show.twig', [
            'paginations' => $paginate
        ]);
    }
}
