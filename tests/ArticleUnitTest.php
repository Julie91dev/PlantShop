<?php

namespace App\Tests;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use PHPUnit\Framework\TestCase;

class ArticleUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $article = new Article();
        $categorie = new Categorie();
        $sousCategorie = new SousCategorie();

        $article->setNom("nom");
        $article->setDescription("description");
        $article->setImages("image");
        $article->setPrix(2);
        $article->setCategorie($categorie);
        $article->setSousCategorie($sousCategorie);

        $this->assertTrue($article->getNom() === "nom");
        $this->assertTrue($article->getDescription() === "description");
        $this->assertTrue($article->getImages() === "image");
        $this->assertTrue($article->getPrix() == 2);
        $this->assertTrue($article->getCategorie() === $categorie);
        $this->assertTrue($article->getSousCategorie() === $sousCategorie);
    }

    public function testIsFalse(): void
    {

        $article = new Article();
        $categorie = new Categorie();
        $sousCategorie = new SousCategorie();

        $article->setNom("nom");
        $article->setDescription("description");
        $article->setImages("image");
        $article->setPrix(2);
        $article->setCategorie($categorie);
        $article->setSousCategorie($sousCategorie);

        $this->assertFalse($article->getNom() === "false");
        $this->assertFalse($article->getDescription() === "false");
        $this->assertFalse($article->getImages() === "false");
        $this->assertFalse($article->getPrix() === 3);
        $this->assertFalse($article->getCategorie() === new  Categorie());
        $this->assertFalse($article->getSousCategorie() === new SousCategorie());
    }

    public function testIsEmpty(): void
    {

        $article = new Article();

        $this->assertEmpty($article->getNom());
        $this->assertEmpty($article->getDescription());
        $this->assertEmpty($article->getImages());
        $this->assertEmpty($article->getPrix());
        $this->assertEmpty($article->getCategorie());
        $this->assertEmpty($article->getSousCategorie());
        $this->assertEmpty($article->getId());
    }


}
