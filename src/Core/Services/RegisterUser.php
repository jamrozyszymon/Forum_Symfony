<?php

namespace App\Core\Services;

use App\Core\Services\CreateUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Core\ValueObject\UserValueObject;
use App\Core\Services\ValidUserPassword;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class RegisterUser
{
    /** @var $createUser */

    /** @var ValidUserPassword */
    private $validUserPassword;

    public function __construct(EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->createUser = new CreateUser($entityManagerInterface, $userPasswordHasherInterface);
        $this->validUserPassword = new ValidUserPassword;
    }

    public function registerFromRequest(Request $request): void
    {
        $this->validUserPassword->validPasswords($request);
        $this->validUserPassword->validLengthPassword($request);
        $userValueObject = new UserValueObject;
        $userValueObject->name = $request->get('name');
        $userValueObject->email = $request->get('email');
        $userValueObject->password = $request->get('password');
        $this->createUser->create($userValueObject);
        
    }
}
