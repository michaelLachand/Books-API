<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $livre = new Book();
            $livre->setTitle($faker->name);
            $livre->setCoverText($faker->text);

            $manager->persist($livre);
        }

        $manager->flush();
    }
}
