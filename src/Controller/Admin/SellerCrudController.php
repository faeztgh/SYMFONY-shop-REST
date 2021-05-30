<?php

namespace App\Controller\Admin;

use App\Entity\Seller;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SellerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Seller::class;
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
