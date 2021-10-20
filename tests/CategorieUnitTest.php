<?php

namespace App\Tests;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use PHPUnit\Framework\TestCase;

class CategorieUnitTest extends TestCase
{
    public function testIsTrue(): void
    {

        $categorie = new Categorie();

        $categorie->setNom("nom");


        $this->assertTrue($categorie->getNom() === "nom");

    }

    public function testIsFalse(): void
    {

        $categorie = new Categorie();

        $categorie->setNom("nom");


        $this->assertFalse($categorie->getNom() === "false");
    }


    public function testIsEmpty(): void
    {

        $categorie = new Categorie();

        $this->assertEmpty($categorie->getNom());
        $this->assertEmpty($categorie->getId());

    }
    public function testAddGetRemoveArticle()
    {
        $categorie = new Categorie();
        $article = new Article();

        $this->assertEmpty($categorie->getArticles());

        $categorie->addArticle($article);
        $this->assertContains($article, $categorie->getArticles());

        $categorie->removeArticle($article);
        $this->assertEmpty($categorie->getArticles());
    }

    public function testAddGetRemoveSousCategorie()
    {
        $categorie = new Categorie();
        $sousCategorie = new SousCategorie();

        $this->assertEmpty($categorie->getSousCategorie());

        $categorie->addSousCategorie($sousCategorie);
        $this->assertContains($sousCategorie, $categorie->getSousCategorie());

        $categorie->removeSousCategorie($sousCategorie);
        $this->assertEmpty($categorie->getSousCategorie());
    }
}
