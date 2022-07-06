<?php

namespace App\Core;

use Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 * Validate setting password
 */
class ValidUserPassword
{
    public function validPasswords(Request $request): void
    {
        if($request->get('password') != $request->get('confirmpassword')) {
            throw new Exception('Podane hasła nie są takie same');
        }
    }

    public function validLengthPassword(Request $request): void
    {
        if(strlen($request->get('password'))<8) {
            throw new Exception('Hasło musi zawierać co najmniej 8 znaków.');
        }
    }
}
