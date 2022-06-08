<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeFrontController extends AbstractController
{
    #[Route('/accueil-front', name: 'app_mainfront')]
    public function index(): Response
    {
        return $this->render('homefront/index.html.twig', [
            'controller_name' => 'HomeFrontController',
        ]);
    }
}
