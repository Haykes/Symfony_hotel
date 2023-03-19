<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

use App\Entity\Establishment;
use App\Entity\Suite;
use App\Entity\Manager;

class DashboardController extends AbstractDashboardController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $user = $this->security->getUser();
        return $this->render('admin/dashboard.html.twig', [
            'user' => $user,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Etablissements', 'fas fa-feather', Establishment::class);
        yield MenuItem::linkToCrud('Suites', 'fas fa-feather', Suite::class);
        yield MenuItem::linkToCrud('Managers', 'fas fa-users-cog', Manager::class); // Ajout du lien vers les managers
    }
}
