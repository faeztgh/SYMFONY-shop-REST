<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            AssociationField::new('seller'),
            AssociationField::new('categories')
                ->addCssClass('text-center')
            ,
            TextField::new("fullName"),
            NumberField::new("price"),
            NumberField::new("weight"),
            TextareaField::new("briefDescription"),
            TextareaField::new("description")->hideOnIndex(),
            TextField::new("thumbnail")->hideOnIndex(),
            TextField::new("image")->hideOnIndex(),
            DateTimeField::new("createdAt"),
            DateTimeField::new("updatedAt")
        ];
    }

}
