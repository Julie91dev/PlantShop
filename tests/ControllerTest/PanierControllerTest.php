<?php

namespace App\Tests\ControllerTest;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PanierControllerTest extends WebTestCase
{
    public function testPagePanier(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/panier');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Votre panier');
    }

//    public function testAddPanier(): void
//    {
//        $client = static::createClient();
//        $userRepository = static::getContainer()->get(UserRepository::class);
//        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
//        $client->loginUser($testUser);
//        $crawler = $client->request('GET', '/panier/add/1');
//
//        $this->assertResponseIsSuccessful();
//        $response = $client->getResponse();
//        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());
//        $location = $response->headers->get('panier');
//
//        $this->assertEquals('/panier', $location);
//    }

    public function testPanierLivraison(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/panier/livraison');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Livraison');
    }

    /*public function testPanierValidation(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/panier/validation');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Validation de votre panier');
    }*/
}
