<?php

namespace App\DataFixtures;

use App\Entity\Manager;
use App\Entity\Establishment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ManagerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création d'un établissement pour le manager spécifique
        $establishment = new Establishment();
        $establishment->setName('Establishment for Specific Manager')
            ->setCity('Specific City')
            ->setAdress('Specific Address')
            ->setDescription('Specific Description');

        $manager->persist($establishment);

        // Création d'un manager spécifique avec les identifiants souhaités
        $specificManager = new Manager();
        $specificManager->setFirstName('Manager')
            ->setLastName('Example')
            ->setEmail('manager@example.com')
            ->setPassword(password_hash('password', PASSWORD_DEFAULT))
            ->setRoles(['ROLE_MANAGER']) // Ajout du rôle ici
            ->setEstablishment($establishment);

        $manager->persist($specificManager);
        $manager->flush();
    }
}
