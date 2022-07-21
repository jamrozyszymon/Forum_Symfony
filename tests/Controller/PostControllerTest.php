<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class PostControllerTest extends WebTestCase
{
    public function setUp(): void
    {
        $this->client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('user2@user.com');

        // simulate $testUser being logged in
        $this->client->loginUser($testUser);
    }

    public function testAddPostPath()
    {
        $crawler = $this-> client->request('GET', '/Post/create');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Dodaj post');
    }
}
