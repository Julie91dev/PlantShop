<?php

namespace App\Tests\ControllerTest;

use App\Repository\CommandeRepository;
use App\Repository\UserRepository;
use App\Service\Commande\CommandeService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandeControllerTest extends WebTestCase
{
   public function testCommandeValidation()
    {
        //TODO: revoir ce test
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/commande/validation/7');

        $commandeService = static::getContainer()->get(CommandeService::class);
        $commandeRepository = static::getContainer()->get(CommandeRepository::class);
        $commandeTest = $commandeRepository->find(7);
        $commande = $commandeService->validationCommande($commandeTest);

        $this->assertResponseRedirects('/profile/facture');
    }
}
