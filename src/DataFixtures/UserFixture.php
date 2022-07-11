<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=10; $i++ ) {
            $user = new User();
            $user->setName('user'.$i);
            $user->setEmail('user'.$i.'@user.com');
            $passwordHashed = $this->userPasswordHasherInterface->hashPassword($user, '123123123');
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($passwordHashed);

            $manager->persist($user);

            $manager->flush();
        }
    }
}
