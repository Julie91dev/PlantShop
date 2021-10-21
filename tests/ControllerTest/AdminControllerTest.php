<?php

namespace App\Tests\ControllerTest;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testAccesPageAdmin(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'admin@admin.fr']);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/admin');
       // $this->assertResponseStatusCodeSame(403);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Administration');
    }
}
