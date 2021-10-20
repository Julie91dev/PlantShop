<?php

namespace App\Tests;

use App\Entity\Adresse;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class AdresseTest extends TestCase
{
    public function testIsTrue(): void
    {
        $adresse = new Adresse();
        $user = new User();
        $date = new \DateTime();

        $adresse->setTelephone(0203040506);
        $adresse->setNom("nom");
        $adresse->setPrenom("prenom");
        $adresse->setNumero(2);
        $adresse->setRue("rue de la paix");
        $adresse->setCp(49000);
        $adresse->setVille("Angers");
        $adresse->setClient($user);
        $adresse->setDateCreation($date);

        $this->assertTrue($adresse->getTelephone() === 0203040506);
        $this->assertTrue($adresse->getNom() === "nom");
        $this->assertTrue($adresse->getPrenom() === "prenom");
        $this->assertTrue($adresse->getNumero() === 2);
        $this->assertTrue($adresse->getRue() === "rue de la paix");
        $this->assertTrue($adresse->getCp() === 49000);
        $this->assertTrue($adresse->getVille() === "Angers");
        $this->assertTrue( $adresse->getClient() === $user);
        $this->assertTrue($adresse->getDateCreation() === $date );
    }

    public function testIsFalse(): void
    {

        $adresse = new Adresse();
        $user = new User();
        $date = new \DateTime();

        $adresse->setTelephone(0203040506);
        $adresse->setNom("nom");
        $adresse->setPrenom("prenom");
        $adresse->setNumero(2);
        $adresse->setRue("rue de la paix");
        $adresse->setCp(49000);
        $adresse->setVille("Angers");
        $adresse->setClient($user);
        $adresse->setDateCreation($date);

        $this->assertFalse($adresse->getTelephone() === 0203040512);
        $this->assertFalse($adresse->getNom() === "false");
        $this->assertFalse($adresse->getPrenom() === "false");
        $this->assertFalse($adresse->getNumero() === 3);
        $this->assertFalse($adresse->getRue() === "rue de la guerre");
        $this->assertFalse($adresse->getCp() === 49001);
        $this->assertFalse($adresse->getVille() === "Paris");
        $this->assertFalse( $adresse->getClient() === new User());
        $this->assertFalse($adresse->getDateCreation() === new \DateTime());
    }

    public function testIsEmpty(): void
    {

        $adresse = new Adresse();

        $this->assertEmpty($adresse->getNom());
        $this->assertEmpty($adresse->getPrenom());
        $this->assertEmpty($adresse->getTelephone());
        $this->assertEmpty($adresse->getNumero());
        $this->assertEmpty($adresse->getVille());
        $this->assertEmpty($adresse->getRue());
        $this->assertEmpty($adresse->getCp());
        $this->assertEmpty($adresse->getClient());
        $this->assertEmpty($adresse->getDateCreation());
        $this->assertEmpty($adresse->getId());
    }
}
