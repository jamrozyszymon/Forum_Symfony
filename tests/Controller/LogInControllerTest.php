<?php

namespace App\Tests\Controller;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LogInControllerTest extends WebTestCase
{
    public function testRedirectToLoginPage()
    {
        $client = static::createClient();
        $client->request('GET', '/user/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Zaloguj się');
    }

    public function testVisitingWhileLoggedIn()
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('user2@user.com');

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        $client->request('GET', '/user/dashboard');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Panel Użytkownika');
    }

    /**
     * @dataProvider getSecureUrl
     */
    public function testRedirectForNonAuthorizatedUser($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);
        $client->followRedirect();
        $this->assertTrue(true, $client->getResponse()->isRedirect('/user/login/'));

    }

    public function getSecureUrl()
    {
        yield ['/user/dashboard'];
    }


    //test security of admin page
    /**
     * @dataProvider getSecureAdminUrl
     */
    public function testRedirectFromAdminUrlForNonAuthenticatedUser($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);
        $client->followRedirect();
        $this->assertTrue(true, $client->getResponse()->isRedirect('/user/login/'));

    }

    public function getSecureAdminUrl()
    {
        yield ['/admin'];
        yield ['/admin/category/create'];
        yield ['/admin/category/delete/1'];
        yield ['/admin/users'];
        yield ['/admin/users/delete/2'];
    }
    //end test security of admin page
}

