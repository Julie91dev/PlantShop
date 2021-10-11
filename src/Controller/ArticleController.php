<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article")
     */
    public function article(int $id, ArticleRepository $articleRepository, CategorieRepository $categorieRepository): Response
    {
        $categoriePlante = $categorieRepository->find(1);
        $categorieDecoration = $categorieRepository->find(2);
        $categorieOutil = $categorieRepository->find(3);
        $articles = $articleRepository->findBy(['categorie' => $id]);

        return $this->render('article/list.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
            'plante' => $categoriePlante,
            'decoration' => $categorieDecoration,
            'outil' => $categorieOutil,
        ]);

    }

    /**
     * @Route("/article/details/{id}", name="article_details")
     */
    public function details(int $id, ArticleRepository $articleRepository, CategorieRepository $categorieRepository){

        $categoriePlante = $categorieRepository->find(1);
        $categorieDecoration = $categorieRepository->find(2);
        $categorieOutil = $categorieRepository->find(3);


        $article = $articleRepository->find($id);

        return $this->render('article/detail.html.twig', [
            'controller_name' => 'ArticleController',
            'article' => $article,
            'plante' => $categoriePlante,
            'decoration' => $categorieDecoration,
            'outil' => $categorieOutil,
        ]);

    }

}
