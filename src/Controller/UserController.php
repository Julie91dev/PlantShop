<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Service\Categorie\CategorieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(CategorieService $categorieService): Response
    {
        $categorie = $categorieService->getCategorie();

        return $this->render('user/profile.html.twig', [
            'controller_name' => 'UserController',
            'categorie' => $categorie
        ]);
    }
}
