<?php

namespace App\DataFixtures;

use App\Entity\Establishment;
use App\Entity\Manager;
use App\Entity\Suite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        // Création de 5 établissements
        for ($i = 0; $i < 5; $i++) {
            $establishment = new Establishment();
            $establishment->setName($faker->company())
                ->setCity($faker->city())
                ->setAdress($faker->address())
                ->setDescription($faker->text());

            $manager->persist($establishment);

            // Création de 5 suites pour chaque établissement
            for ($j = 0; $j < 5; $j++) {
                $suite = new Suite();
                $suite->setEstablishment($establishment)
                    ->setTitle($faker->jobTitle())
                    ->setImage($faker->imageUrl(640, 480, 'cats'))
                    ->setDescription($faker->text())
                    ->setPrice($faker->randomFloat(2, 50, 500));

                $manager->persist($suite);
            }

            // Création de 3 gérants pour chaque établissement
            for ($k = 0; $k < 3; $k++) {
                $managerEntity = new Manager();
                $managerEntity->setFirstName($faker->firstName())
                    ->setLastName($faker->lastName())
                    ->setEmail($faker->unique()->email())
                    ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                    ->setRoles(['ROLE_MANAGER'])
                    ->setEstablishment($establishment);

                $manager->persist($managerEntity);
            }
        }

        $manager->flush();
    }
}
