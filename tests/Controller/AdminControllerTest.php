<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class AdminControllerTest extends WebTestCase
{
    public function testAddCategoryRedirectToPath()
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('admin@admin.com');

        // simulate $testUser being logged in
        $client->loginUser($testUser);
   
        $client->request('GET', '/admin/category/create');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Stwórz kategorię');
    }

}
