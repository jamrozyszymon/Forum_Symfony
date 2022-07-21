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
use Knp\Component\Pager\PaginatorInterface;

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
            return $this->redirectToRoute('ADMIN DASHBOARD');
        }

        return $this->render('Category/create.html.twig', [
            'form' =>$form->createView()
        ]);
    }


    /**
     * @Route("/category/delete/{id}", name= "admin_category_delete")
     */
    public function deleteCategory(ManagerRegistry $doctrine, Category $id)
    {
        $entityManagerInterface = $doctrine->getManager();
        $entityManagerInterface->remove($id);
        $entityManagerInterface->flush();
        return $this->redirectToRoute('category_display');
    }


    /**
     * @Route("/users", name="admin_user_display")
     */
    public function getUsers(ManagerRegistry $doctrine, PaginatorInterface $paginator, Request $request): Response
    {
        $users = $doctrine->getRepository(User::class)->findAll();

        $paginate = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1), 10
        );

        return $this->render('admin/user_display.html.twig', [
            'paginations' => $paginate
        ]);
    }

    /**
     * @Route("/users/delete/{id}", name="admin_user_delete")
     */
    public function deleteUser(ManagerRegistry $doctrine, User $id)
    {
        $entityManagerInterface = $doctrine->getManager();
        $entityManagerInterface->remove($id);
        $entityManagerInterface->flush();
        return $this->redirectToRoute('admin_user_display');
    }
}
