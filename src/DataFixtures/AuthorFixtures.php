<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\fr_FR\Person;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new Person($faker));

        for ($i = 0; $i < 20; $i++) {
            $author = new Author();
            $author->setLastName($faker->lastName);
            $author->setFirstName($faker->firstName);

            $manager->persist($author);
            $this->setReference('author' . $i, $author);
        }

        $manager->flush();
    }
}
