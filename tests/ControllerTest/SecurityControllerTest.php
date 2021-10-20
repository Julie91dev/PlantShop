<?php

namespace App\Tests\ControllerTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Se connecter');
    }

    public function testVisitingWhileLoggedIn()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $buttonCrawlerNode = $crawler->selectButton('Connexion');
        $form = $buttonCrawlerNode->form();

        $form = $buttonCrawlerNode->form([
            'email' => 'test@test.fr',
            'password' => 'test123',
        ]);

        $client->submit($form);

        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }
}
