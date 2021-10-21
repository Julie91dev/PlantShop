<?php

namespace App\Tests\ControllerTest;


use App\Repository\UserRepository;
use App\Service\Panier\PanierService;
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

    public function testAddPanier(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/panier/add/1');

        $servicePanier = static::getContainer()->get(PanierService::class);
        $test= $servicePanier->addPanier(1);

        $this->assertResponseRedirects('/panier');

    }

    public function testRemoveQuantityPanier(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/panier/remove/1');

        $servicePanier = static::getContainer()->get(PanierService::class);
        $test= $servicePanier->removeQuantityPanier(1);

        $this->assertResponseRedirects('/panier');

    }

    public function testRemoveProduitPanier(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/panier/delete/1');

        $servicePanier = static::getContainer()->get(PanierService::class);
        $test= $servicePanier->deleteProduitPanier(1);

        $this->assertResponseRedirects('/panier');

    }
    public function testDeletePanier(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/panier/delete');

        /*$servicePanier = static::getContainer()->get(PanierService::class);
        $test= $servicePanier->removeQuantityPanier(1);*/

        $this->assertResponseRedirects('/panier');

    }

    public function testPanierLivraison(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/panier/livraison');
        if (!$client){
            $this->assertResponseRedirects('/login');
        }
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Livraison');
    }

    public function testPanierValidation(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);


        $crawler = $client->request('GET', '/panier/validation');

        $request = $client->getRequest();
        $servicePanier = static::getContainer()->get(PanierService::class);
        $test= $servicePanier->validerPanier($request);
        $this->assertResponseRedirects('/panier');
    }
}
