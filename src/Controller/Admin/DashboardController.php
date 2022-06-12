<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;


use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
   
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {

    }
   
   
   
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(ArticleCrudController::class)
            ->generateUrl();
            
        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Panel Administrateur');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour sur le site', 'fa fa-arrow-left', 'app_main');
        
        yield MenuItem::subMenu('Projets', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Tous les Projets', 'fas fa-newspaper', Article::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class)
        ]);

        yield MenuItem::subMenu('Menus', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Pages', 'fas fa-file', Menu::class),
            MenuItem::linkToCrud('Projets', 'fas fa-newspaper', Menu::class),
            MenuItem::linkToCrud('Lien personnalisés', 'fas fa-link', Menu::class),
            MenuItem::linkToCrud('Catégories', 'fab fa-delicious', Menu::class),
        ]);
 
        yield MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Comment::class);
    }
}
