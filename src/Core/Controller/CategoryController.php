<?php

namespace App\Core\Controller;

use App\Core\Services\GetCategories;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Category;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public function displayCategories(ManagerRegistry $doctrine)
    {
        $categories = $doctrine->getRepository(Category::class)->findAll();

        return $this->render('Category/category_tree.html.twig', [
            'categories' => $categories
        ]);
    }


    /**
     * @Route("/Category/display", name="category_display")
     */
    public function showCategory(ManagerRegistry $doctrine, PaginatorInterface $paginator, Request $request)
    {
        $categories = $doctrine->getRepository(Category::class)->findAll();

        $paginate = $paginator->paginate(
            $categories,
            $request->query->getInt('page', 1), 5
        );

        if (!$categories) {
            throw $this->createNotFoundException(
                'Brak kategorii do wyświelenia.'
            );
        }
        return $this->render('Category/display.html.twig', [
            'paginations' => $paginate
        ]);
    }

}
