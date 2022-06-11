<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'app_main')]
    public function index(ArticleRepository $articleRepo, CategoryRepository $categoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepo->findAll(),
            'categories' => $categoryRepository->findAll()

        ]);
    }

    #[Route('/accueil/{slug}', name: 'show_main')]
    public function show(?Article $article, ?Category $categoriea): Response
    {
        if (!$article) {
            return $this->redirectToRoute('app_main');
        }
        return $this->render('home/index.html.twig', [
            'article' => $article,
            'categories' => $categoriea
        ]);
    } 
}
