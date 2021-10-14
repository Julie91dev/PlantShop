<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Service\Categorie\CategorieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article")
     */
    public function article(int $id, ArticleRepository $articleRepository, CategorieService $categorieService): Response
    {
        $categorie = $categorieService->getCategorie();
        $articles = $articleRepository->findBy(['categorie' => $id]);

        return $this->render('article/list.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
            'categorie' => $categorie
        ]);

    }

    /**
     * @Route("/article/details/{id}", name="article_details")
     */
    public function details(int $id, ArticleRepository $articleRepository, CategorieService $categorieService){

        $categorie = $categorieService->getCategorie();


        $article = $articleRepository->find($id);

        return $this->render('article/detail.html.twig', [
            'controller_name' => 'ArticleController',
            'article' => $article,
            'categorie' => $categorie
        ]);

    }

}
