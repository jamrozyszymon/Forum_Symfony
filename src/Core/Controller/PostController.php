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
use App\Entity\Category;


class PostController extends AbstractController
{
    /**
     *  @Route("/Post/create", name="post_create")
     */
    public function create(CreatePost $createPost, Request $request)
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
        return $this->render('Post/create.html.twig');
    }

    /**
     * @Route("/Post/display/category/{categoryname},{id}", name="post_display")
     */
    public function showPost(ManagerRegistry $doctrine,  PaginatorInterface $paginator, Request $request, Category $id)
    {
        $posts = $doctrine->getRepository(Post::class)->findBy(['id' => $id]);
        
        $paginate = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1), 5
        );

        if (!$posts) {
            throw $this->createNotFoundException(
                'Brak postów do wyświelenia.'
            );
        }
        return $this->render('Post/display.html.twig', [
            'paginations' => $paginate
        ]);
    }

    /**
     * @Route("/Post/delete/{id}", name= "post_delete")
     */
    public function deletePost(ManagerRegistry $doctrine, Post $id)
    {
        $entityManagerInterface = $doctrine->getManager();
        $entityManagerInterface->remove($id);
        $entityManagerInterface->flush();
        return $this->redirectToRoute('post_display');
    }

    public function categories(ManagerRegistry $doctrine)
    {
        $categories = $doctrine->getRepository(Category::class)->findAll();

        return $this->render('Post/category.html.twig', [
            'categories' => $categories
        ]);
    }
}
