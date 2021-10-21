<?php

namespace App\Tests\ControllerTest;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdresseControllerTest extends WebTestCase
{
    public function testPageAdresse(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/profile/adresse');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Vos adresse');

    }

    public function testAjoutAdresse(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/profile/adresse/add');

        $form = $crawler->selectButton('Ajouter une adresse')->form();

        $form['adresse[nom]'] = 'Testounet';
        $form['adresse[prenom]'] = 'Li';
        $form['adresse[telephone]'] = 235000000;
        $form['adresse[numero]'] = 2;
        $form['adresse[rue]'] = 'rue du Chat';
        $form['adresse[cp]'] = 41250;
        $form['adresse[ville]'] = 'Loudo';


        $client->submit($form);

        $crawler = $client->request('GET', '/profile/adresse');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h6', '2 rue du Chat');

    }

    public function testModifierAdresse(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/profile/adresse/update/4');

        $form = $crawler->selectButton('Enregistrer les modifications')->form();

        $form['adresse[nom]'] = 'Testounet';
        $form['adresse[prenom]'] = 'Li';
        $form['adresse[telephone]'] = 235000000;
        $form['adresse[numero]'] = 2;
        $form['adresse[rue]'] = 'rue du Chat';
        $form['adresse[cp]'] = 41250;
        $form['adresse[ville]'] = 'Loudo';


        $client->submit($form);

        $crawler = $client->request('GET', '/profile/adresse');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h6', '2 rue du Chat');

    }

/*    public function testgetAdresse()
    {

        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);
        $data = ['idAdresse' => 4];
        $crawler = $client->xmlHttpRequest('POST', '/profile/adresseId', ['data' => $data]);

        $this->assertResponseIsSuccessful();
    }*/

   /* public function testdeleteAdresse()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'test@test.fr']);
        $client->loginUser($testUser);

        $crawler = $client->xmlHttpRequest('POST', '/profile/adresse/delete', ['idAdresse' => 4]);

        $this->assertResponseIsSuccessful();
    }*/
}
