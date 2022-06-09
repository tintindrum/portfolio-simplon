<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'app_main')]
    public function index(ArticleRepository $articleRepo): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepo->findAll()
        ]);
    }
}
