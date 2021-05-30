<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdminCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }


    public function configureFields(string $pageName): iterable
    {
        if ($this->isGranted('ROLE_SUPER_ADMIN') === false) {
            $this->redirect('admin');
        }
        return [
            TextField::new('fullName'),
            TextField::new('username')->setHelp('Must be unique'),
            TextField::new('email'),
            ChoiceField::new('roles', 'roles')
                ->setChoices([
                    "ROLE_ADMIN" => "ROLE_ADMIN",
                    "ROLE_USER" => "ROLE_USER",
                    "ROLE_SUPER_ADMIN" => "ROLE_SUPER_ADMIN"
                ])->allowMultipleChoices()
        ];
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_SUPER_ADMIN');
    }
}
