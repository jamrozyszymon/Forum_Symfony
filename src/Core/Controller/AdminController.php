<?php

namespace App\Core\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("", name="admin_dashboard")
     */
    public function index(): Response
    {
        $user = new User();
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user=$this->getUser();
        return $this->render('admin/dashboard.html.twig');
    }

    /**
     * @Route("/category/create", name="admin_category_create")
     */
    public function createCategory(ManagerRegistry $doctrine, Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $entityManager = $doctrine->getManager();
            $category->setname($request->get('category')['name']);
            $entityManager->persist($category);
            $entityManager->flush();
        }

        return $this->render('Category/create.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/users", name="admin_users")
     */
    public function getUsers(): Response
    {
        return $this->render('admin/users.html.twig');
    }
}
