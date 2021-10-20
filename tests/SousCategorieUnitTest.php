<?php

namespace App\Tests;

use App\Entity\SousCategorie;
use PHPUnit\Framework\TestCase;

class SousCategorieUnitTest extends TestCase
{
    public function testIsTrue(): void
    {

        $sousCategorie = new SousCategorie();

        $sousCategorie->setNom("nom");


        $this->assertTrue($sousCategorie->getNom() === "nom");

    }

    public function testIsFalse(): void
    {

        $sousCategorie = new SousCategorie();

        $sousCategorie->setNom("nom");


        $this->assertFalse($sousCategorie->getNom() === "false");
    }


    public function testIsEmpty(): void
    {

        $sousCategorie = new SousCategorie();

        $this->assertEmpty($sousCategorie->getNom());
        $this->assertEmpty($sousCategorie->getId());

    }
}
