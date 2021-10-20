<?php

namespace App\Tests;

use App\Entity\Commande;
use App\Entity\User;
use Doctrine\DBAL\Types\ArrayType;
use PHPUnit\Framework\TestCase;

class CommandeUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $commande = new Commande();
        $user = new User();
        $date = new \DateTime();
        $tableau[] = new ArrayType();

        $commande->setValider(true);
        $commande->setDate($date);
        $commande->setReference(1);
        $commande->setClient($user);
        $commande->setCommande($tableau);

        $this->assertTrue($commande->getValider() === true);
        $this->assertTrue($commande->getDate() === $date);
        $this->assertTrue($commande->getReference() == 1);
        $this->assertTrue( $commande->getClient() === $user);
        $this->assertTrue($commande->getCommande() === $tableau);
    }

    public function testIsFalse(): void
    {

        $commande = new Commande();
        $user = new User();
        $date = new \DateTime();
        $tableau[] = new ArrayType();

        $commande->setValider(true);
        $commande->setDate($date);
        $commande->setReference(1);
        $commande->setClient($user);
        $commande->setCommande($tableau);

        $this->assertFalse($commande->getValider() === false);
        $this->assertFalse($commande->getDate() === new \DateTime());
        $this->assertFalse($commande->getReference() === 2);
        $this->assertFalse( $commande->getClient() === new User());
        $this->assertFalse($commande->getCommande() === new ArrayType());
    }

    public function testIsEmpty(): void
    {

        $commande = new Commande();

        $this->assertEmpty($commande->getValider());
        $this->assertEmpty($commande->getDate());
        $this->assertEmpty($commande->getReference());
        $this->assertEmpty($commande->getClient());
        $this->assertEmpty($commande->getCommande());
        $this->assertEmpty($commande->getId());
    }
}
