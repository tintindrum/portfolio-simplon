<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\RequestStack;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;

class MenuCrudController extends AbstractCrudController
{   


    const MENU_PAGES = 0;
    const MENU_ARTICLES = 1;
    const MENU_LINKS = 2;
    const MENU_CATEGORIES = 3;

    public function __construct(
        private MenuRepository $menuRepo,
        private RequestStack $requestStack
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return Menu::class;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $subMenuIndex = $this->getSubMenuIndex();

        return $this->menuRepo->getIndexQueryBuilder($this->getFieldNameFromSubMenuIndex($subMenuIndex));
    }

    public function configureCrud(Crud $crud): Crud
    {
        $subMenuIndex = $this->getSubMenuIndex();
        
        $entitylabelInSingular = 'un menu';

        $entitylabelInPlural = match ($subMenuIndex){
            self::MENU_ARTICLES => 'Projets',
            self::MENU_CATEGORIES => 'Catégories',
            self::MENU_LINKS => 'Liens personnalisés',
            default => 'Pages'
        };

        return $crud 
            ->setEntityLabelInSingular($entitylabelInSingular)
            ->setEntityLabelInPlural($entitylabelInPlural);
        
    }


    public function configureFields(string $pageName): iterable
    {
        
        $subMenuIndex = $this->getSubMenuIndex();

        yield TextField::new('name','Titre de la navigation');
        
        yield NumberField::new('menuOrder', 'Ordre');
        
        yield $this->getFieldFromSubMenuIndex($subMenuIndex)
            ->setRequired(true);

        
        yield BooleanField::new('isVisible', 'Visible');
        
        yield AssociationField::new('subMenus', 'Sous-éléments');


        
    }

    private function getFieldNameFromSubMenuIndex(int $subMenuIndex): string
    {
        return match ($subMenuIndex){
            self::MENU_ARTICLES => 'article',
            self::MENU_CATEGORIES => 'category',
            self::MENU_LINKS => 'link',
            default => 'page'
        };
    }

    private function getFieldFromSubMenuIndex(int $subMenuIndex)
    {
       $fieldName = $this->getFieldNameFromSubMenuIndex($subMenuIndex);


        return ($fieldName == 'link') ? TextField::new($fieldName, 'Lien') : AssociationField::new($fieldName);
    }

    private function getSubMenuIndex(): int
    {
        return $this->requestStack->getMainRequest()->query->getInt('submenuIndex');
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
