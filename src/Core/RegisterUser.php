<?php

namespace App\Core;

use App\Core\CreateUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Core\ValueObject\UserValueObject;
use App\Core\ValidUserData;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class RegisterUser
{
    /** @var $createUser */

    /** @var ValidUserData */
    private $validUserData;

    public function __construct(EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->createUser= new CreateUser($entityManagerInterface, $userPasswordHasherInterface);
        $this->validUserData= new ValidUserData;
    }

    public function registerFromRequest(Request $request): void
    {
        $this->validUserData->valid($request);
        $userValueObject = new UserValueObject;
        $userValueObject->email = $request->get('email');
        $userValueObject->password = $request->get('password');
        $this->createUser->create($userValueObject);
        
    }
}
