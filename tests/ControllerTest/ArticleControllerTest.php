<?php

namespace App\Tests\ControllerTest;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Service\Categorie\CategorieService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testPageArticlePlante(): void
    {
        $client = static::createClient();

        $categorieRepository = static::getContainer()->get(CategorieRepository::class);
        $testCategorie = $categorieRepository->find(1);
        $crawler = $client->request('GET', '/article/1');

        $this->assertResponseIsSuccessful();
    }

    public function testPageArticlePlanteDetail(): void
    {
        $client = static::createClient();
        /*$categorieRepository = static::getContainer()->get(CategorieService::class);
        $testCategorie = $categorieRepository->find(1);*/


        $articleRepository = static::getContainer()->get(ArticleRepository::class);
        $testArticle = $articleRepository->find(1);
        $crawler = $client->request('GET', '/article/details/1');

        $this->assertResponseIsSuccessful();
    }
}
