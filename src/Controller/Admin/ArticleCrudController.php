<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextEditorField::new('description'),
            NumberField::new('prix'),
            AssociationField::new('categorie'),
            AssociationField::new('sousCategorie'),
            DateField::new('createdAt')->setLabel('Créé le'),

            Field::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms()
            ->setLabel('ImageField'),
            ImageField::new('images')->setBasePath('/PlantShop/public/img/article/')
                ->setUploadDir('/public/img/article/')
            ->setLabel('Image')
        ];
    }

}
