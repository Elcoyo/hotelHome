<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Membre;
use App\Entity\Slider;
use App\Entity\Chambre;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('HotelHouse');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Accueil', 'fa fa-home'),
            MenuItem::section('ADMIN'),
            MenuItem::subMenu('CRUD','fa fa-newspaper')->setsubItems([
                MenuItem::linkToCrud('Chambre', 'fa-solid fa-person-booth', Chambre::class),
                MenuItem::linkToCrud('Slider', 'fa-solid fa-sliders', Slider::class),
                MenuItem::linkToCrud('Commande', 'fa-solid fa-terminal', Commande::class),
            ]),
            MenuItem::section('Utilisateur'),
            MenuItem::linkToCrud('User','fa-solid fa-user', User::class),

            MenuItem::section('Retour au site'),
            MenuItem::linkToRoute('Accueil du site', 'fa fa-igloo', 'accueil'),

            
        ];
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
