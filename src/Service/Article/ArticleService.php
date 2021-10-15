<?php

namespace App\Service\Article;

use App\Repository\ArticleRepository;

class ArticleService
{
    //TODO: implémenter les méthode
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getArticlesByCategorie($id)
    {
        $articles = $this->articleRepository->findBy(['categorie' => $id]);

        return $articles;
    }
    public function getDetailArticle($id)
    {
        $articles = $this->articleRepository->find($id);

        return $articles;
    }
}