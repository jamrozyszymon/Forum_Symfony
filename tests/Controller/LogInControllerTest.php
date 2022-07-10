<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class LogInControllerTest extends WebTestCase
{
    
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/user/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Zaloguj się');

        $link = $crawler
        ->filter('a:contains("Zarejestruj się")')
        ->link();

        $crawler = $client->click($link);
        $this->assertStringContainsString('Rejestracja', $client->getResponse()->getContent());
        

        //$form = $crawler
        //->filter('button:contains("Zaloguj")')
        //->link();
        /*
        $form = $crawler->selectButton('Zaloguj')->form();


        $form['username']="t@tt.com";
        $form['password']="123123123";
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();
        //$this->assertEquals($crawler->filter('a:contains("Wyloguj")')->count()>0);
        $this->assertStringContainsString('Forum', $client->getResponse()->getContent());
        */
    } 
}
