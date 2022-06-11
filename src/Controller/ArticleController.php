<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use App\Form\Type\CommentType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    
    #[Route('/articles', name: 'app_articles')]
    public function index(ArticleRepository $ArticleRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $ArticleRepository->findAll(),
            'categories' => $categoryRepository->findAll()
        ]);
    }
    
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(?Article $article, ?Category $categoriea): Response
    {
        if (!$article) {
            return $this->redirectToRoute('app_main');
        }
        $comment = new Comment($article);

        $commentForm = $this->createForm(CommentType::class, $comment);


        return $this->renderForm('article/show.html.twig', [
            'article' => $article,
            'commentForm' => $commentForm
        ]);
    }

   

   
}
