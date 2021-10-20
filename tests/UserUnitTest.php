<?php

namespace App\Tests;

use App\Entity\Adresse;
use App\Entity\Article;
use App\Entity\Commande;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue(): void
    {

        $user = new User();

        $user->setNom("nom");
        $user->setPrenom("prenom");
        $user->setEmail("test@test.fr");
        $user->setPassword("password");
        $user->setRoles(['ROLE_TEST']);


        $this->assertTrue($user->getNom() === "nom");
        $this->assertTrue($user->getPrenom() === "prenom");
        $this->assertTrue($user->getEmail() === "test@test.fr");
        $this->assertTrue($user->getPassword() === "password");
        $this->assertTrue($user->getRoles() == ['ROLE_TEST']);
        $this->assertTrue($user->getUserIdentifier() === "test@test.fr");
    }

    public function testIsFalse(): void
    {

        $user = new User();

        $user->setNom("nom");
        $user->setPrenom("prenom");
        $user->setEmail("true@test.fr");
        $user->setPassword("password");
        $user->setRoles(['ROLE_TEST']);

        $this->assertFalse($user->getNom() === "false");
        $this->assertFalse($user->getPrenom() === "false");
        $this->assertFalse($user->getEmail() === "false@test.fr");
        $this->assertFalse($user->getPassword() === "false");
        $this->assertFalse($user->getUserIdentifier() === "false@test.fr");

    }

    public function testIsEmpty(): void
    {

        $user = new User();

        $this->assertEmpty($user->getNom());
        $this->assertEmpty($user->getPrenom());
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getUserIdentifier());
        $this->assertEmpty($user->getId());
    }

    public function testAddGetRemoveAdresse()
    {
        $user = new User();
        $adresse = new Adresse();

        $this->assertEmpty($user->getAdresses());

        $user->addAdress($adresse);
        $this->assertContains($adresse, $user->getAdresses());

        $user->removeAdress($adresse);
        $this->assertEmpty($user->getAdresses());
    }

    public function testAddGetRemoveCommande()
    {
        $user = new User();
        $commande = new Commande();

        $this->assertEmpty($user->getCommandes());

        $user->addCommande($commande);
        $this->assertContains($commande, $user->getCommandes());

        $user->removeCommande($commande);
        $this->assertEmpty($user->getCommandes());
    }
}
