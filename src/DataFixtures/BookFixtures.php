<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setTitle($faker->name);
            $book->setCoverText($faker->text);
            $book->setComment($faker->text);
            $book->setAuthor($this->getReference('author' . $faker->numberBetween(0, 19)));

            $manager->persist($book);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AuthorFixtures::class,
        ];
    }
}
