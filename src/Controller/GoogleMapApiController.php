<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GoogleMapApiController extends AbstractController
{
    #[Route('/maps', name: 'app_google_map_api')]
    public function index(): Response
    {
        return $this->render('google_map_api/index.html.twig', [
            'controller_name' => 'GoogleMapApiController',
        ]);
    }

     #[Route('/googlenewmap', name: 'app_google_map_action')]
    public function mapAction()
    {
        return $this->render('google_map_api/newMap.html.twig');
    }
}
