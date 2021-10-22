<?php

namespace App\Tests;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\File;

class ArticleUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $article = new Article();
        $categorie = new Categorie();
        $sousCategorie = new SousCategorie();
        $file = new File('public/img/article/areca.jpg');

        $article->setNom("nom");
        $article->setDescription("description");
        $article->setImages("image");
        $article->setPrix(2);
        $article->setCategorie($categorie);
        $article->setSousCategorie($sousCategorie);
        $article->setCreatedAt(new \DateTime('2021-10-22 08:10:00.000000+0000'));
        $article->setUpdatedAt(new \DateTime('2021-10-22 08:10:00.000000+0000'));
        $article->setImageFile($file);

        $this->assertTrue($article->getNom() === "nom");
        $this->assertTrue($article->getDescription() === "description");
        $this->assertTrue($article->getImages() === "image");
        $this->assertTrue($article->getPrix() == 2);
        $this->assertTrue($article->getCategorie() === $categorie);
        $this->assertTrue($article->getSousCategorie() === $sousCategorie);

        $this->assertTrue($article->getImageFile() === $file);
    }

    public function testIsFalse(): void
    {

        $article = new Article();
        $categorie = new Categorie();
        $sousCategorie = new SousCategorie();
        $date = new \DateTime();
        $file = new File('public/img/article/areca.jpg');


        $article->setNom("nom");
        $article->setDescription("description");
        $article->setImages("image");
        $article->setPrix(2);
        $article->setCategorie($categorie);
        $article->setSousCategorie($sousCategorie);
        $article->setCreatedAt($date);
        $article->setUpdatedAt($date);
        $article->setImageFile($file);

        $this->assertFalse($article->getNom() === "false");
        $this->assertFalse($article->getDescription() === "false");
        $this->assertFalse($article->getImages() === "false");
        $this->assertFalse($article->getPrix() === 3);
        $this->assertFalse($article->getCategorie() === new  Categorie());
        $this->assertFalse($article->getSousCategorie() === new SousCategorie());
        $this->assertFalse($article->getCreatedAt() == new \DateTime());
        $this->assertFalse($article->getUpdatedAt() == new \DateTime());
        $this->assertFalse($article->getImageFile() === new File('public/img/article/arrosoir.jpg'));

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
        $this->assertEmpty($article->getCreatedAt());
        $this->assertEmpty($article->getUpdatedAt());
        $this->assertEmpty($article->getImageFile());
    }




}
