<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user','User'),
            TextField::new('country','Country'),
            TextField::new('address','Address'),
            TextField::new('phoneNo')
                ->setFormType(TelType::class)
            ,
            BooleanField::new('isVerified','Verified?'),
        ];
    }

}
