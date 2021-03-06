<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Entity\Category;
use App\Entity\Contact;
use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\Products;
use App\Entity\Seller;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(SellerCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img class="img-thumbnail" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.iconfinder.com%2Ficons%2F568519%2Fglobal_shopping_ecommerce_icon&psig=AOvVaw3MAhyC4DwNPY2a27rZZV0-&ust=1622456186137000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCKiin7qW8fACFQAAAAAdAAAAABAD" alt=""> Faez <small>Corp.</small>');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::subMenu('Users', 'fa fa-folder')->setSubItems([
                MenuItem::linkToCrud('Admins', 'fas fa-user-shield', Admin::class)
                    ->setPermission('ROLE_SUPER_ADMIN'),
                MenuItem::linkToCrud('Sellers', 'fas fa-user-tie', Seller::class),
                MenuItem::linkToCrud('Customers', 'fas fa-user-tag', Customer::class),
                MenuItem::linkToCrud('Users', 'fas fa-user', User::class),
            ]),
            MenuItem::subMenu('Products', 'fa fa-folder')->setSubItems([
                MenuItem::linkToCrud('Products', 'fas fa-shopping-bag', Product::class),

            ]),

            MenuItem::linkToCrud('Category', 'fas fa-clipboard-list', Category::class),
            MenuItem::linkToCrud('Contact', 'fas fa-inbox', Contact::class),

            MenuItem::subMenu('Settings', 'fa fa-cogs')->setSubItems([

            ])
        ];

    }
}
