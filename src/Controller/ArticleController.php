<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Service\Article\ArticleService;
use App\Service\Categorie\CategorieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article")
     */
    public function article(int $id, ArticleService $articleService, CategorieService $categorieService): Response
    {
        $categorie = $categorieService->getCategorie();
        $articles = $articleService->getArticlesByCategorie($id);

        return $this->render('article/list.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
            'categorie' => $categorie
        ]);

    }

    /**
     * @Route("/article/details/{id}", name="article_details")
     */
    public function details(int $id, ArticleService $articleService, CategorieService $categorieService){

        $categorie = $categorieService->getCategorie();

        $article = $articleService->getDetailArticle($id);

        return $this->render('article/detail.html.twig', [
            'controller_name' => 'ArticleController',
            'article' => $article,
            'categorie' => $categorie
        ]);

    }

}
