<?php

namespace App\Tests\ControllerTest;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testUserProfile(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/profile');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Votre compte');
    }

   /* public function testUserProfileCommande(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/profile/commande');

        $this->assertResponseIsSuccessful();
//        $this->assertSelectorTextContains('h2', 'Vos commandes');
    }*/

     public function testUserProfileFacture(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/profile/facture');

        $this->assertResponseIsSuccessful();
    }

    public function testUserProfileMonProfil(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/profile/monprofil');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Mon profil');

    }

     public function testUserProfileMonProfilEdit(): void
     {
         $client = static::createClient();
         $userRepository = static::getContainer()->get(UserRepository::class);
         $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
         $client->loginUser($testUser);
         $crawler = $client->request('GET', '/profile/monprofil/edit/6');

         $this->assertResponseIsSuccessful();
         $this->assertSelectorTextContains('h2', 'Modifier votre profil');

     }
   /* public function testUserProfileMonProfilDelete(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/profile/monprofil/delete/6');

        $this->assertResponseIsSuccessful();

    }*/
}
