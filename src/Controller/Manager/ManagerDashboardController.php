<?php

namespace App\Controller\Manager;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Establishment;
use App\Entity\Suite;
use App\Entity\Reservation;

class ManagerDashboardController extends AbstractDashboardController
{
    #[Route('/manager', name: 'manager_dashboard')]
    public function index(): Response
    {
        return $this->render('manager/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Manager Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Etablissements', 'fas fa-feather', Establishment::class);
        yield MenuItem::linkToCrud('Suites', 'fas fa-feather', Suite::class);
    }
}
