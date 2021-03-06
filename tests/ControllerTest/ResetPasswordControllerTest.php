<?php

namespace App\Tests\ControllerTest;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResetPasswordControllerTest extends WebTestCase
{
    public function testPageResetPassword(): void
    {

        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/reset-password');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Mot de passe oublié');
    }


}
