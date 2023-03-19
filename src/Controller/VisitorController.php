<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Establishment;
use App\Entity\Suite;
use Doctrine\Persistence\ManagerRegistry;

class VisitorController extends AbstractController
{
    #[Route('/visitor', name: 'app_visitor')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $EstablishmentRepository = $doctrine->getRepository(Establishment::class);
        $Establishment = $EstablishmentRepository->findAll();
        $SuiteRepository = $doctrine->getRepository(Suite::class);
        $suites = $SuiteRepository->findAll();

        return $this->render('visitor/index.html.twig', [
            'controller_name' => 'VisitorController',
            'Establishment'=>$Establishment,
            'suites'=>$suites,
        ]);
    }
    


    #[Route('/visitor/{id}', name: 'app_visitor_details')]
    public function single(ManagerRegistry $doctrine, int $id): Response
    {
        $EstablishmentRepository = $doctrine->getRepository(Establishment::class);
        $Establishment = $EstablishmentRepository->find($id);
        $suiteRepository = $doctrine->getRepository(Suite::class);
        $suite = $suiteRepository->findBy(['establishment' => $Establishment]);
        

        return $this->render('visitor/suite.html.twig', [
            'controller_name' => 'VisitorController',
            'establishment'=>$Establishment,
            'suite'=>$suite,
        ]);
    }
}