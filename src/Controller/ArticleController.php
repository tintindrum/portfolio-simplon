<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    
    #[Route('/articles', name: 'app_articles')]
    public function index(ArticleRepository $ArticleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $ArticleRepository->findAll(),
        ]);
    }
    
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(?Article $article): Response
    {
        if (!$article) {
            return $this->redirectToRoute('app_main');
        }
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

   

   
}
