<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $userAdmin = new User();
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setEmail('admin@mike.fr');
        $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin, 'admin'));
        $manager->persist($userAdmin);

        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $user->setEmail('user@mike.fr');
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'user'));
        $manager->persist($user);



        $manager->flush();
    }
}
