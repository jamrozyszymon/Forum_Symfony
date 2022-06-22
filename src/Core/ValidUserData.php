<?php

namespace App\Core;

use Exception;
use Symfony\Component\HttpFoundation\Request;

class ValidUserData
{
    public function valid(Request $request): void
    {
        if($request->get('password') != $request->get('confirmpassword')) {
            throw new Exception('Podane hasła nie są takie same');
        }
    }
}
