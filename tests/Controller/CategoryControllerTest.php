<?php

namespace App\Tests\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    public function tearDown(): void
    {
        parent::tearDown();

    }

    public function testCategoryDisplay()
    {
        $crawler = $this->client->request('GET', '/Category/display');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Kategorie'); 
    }

}
