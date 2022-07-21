<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    public function testRedirectToRegistrationPage()
    {
        $client = static::createClient();
        $client->request('GET', '/user/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Rejestracja');
    }

}
