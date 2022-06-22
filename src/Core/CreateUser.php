<?php

namespace App\Core;

use App\Core\ValueObject\UserValueObject;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUser
{
    /** @var $entityManagerInterface */
    private $entityManagerInterface;

    /** @var UserPasswordHasherInterface */
    private $userPasswordHasherInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->entityManagerInterface=$entityManagerInterface;
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function create(UserValueObject $userValueObject): void
    {
        $user = new User();
        $user->setEmail($userValueObject->email);
        $passwordHashed = $this->userPasswordHasherInterface->hashPassword($user, $userValueObject->password);
        $user->setRoles($userValueObject->roles ?? []);
        $user->setPassword($passwordHashed);
        $this->entityManagerInterface->persist($user);
        $this->entityManagerInterface->flush();
    }
}
