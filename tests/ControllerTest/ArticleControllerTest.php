<?php

namespace App\Tests\ControllerTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testPageArticlePlante(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/1');

        $this->assertResponseIsSuccessful();
    }

    public function testPageArticlePlanteDetail(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/details/1');

        $this->assertResponseIsSuccessful();
    }
}
