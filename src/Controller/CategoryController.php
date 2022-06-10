<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(CategoryRepository $CategoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $CategoryRepository->findAll(),
        ]);
    }
    
    
    
    #[Route('/categorie/{slug}', name: 'category_show')]
    public function show(?Category $category): Response
    {

        if(!$category){
            return $this->redirectToRoute('app-main');
        }

        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }
}
