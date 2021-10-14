<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Service\Categorie\CategorieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CategorieService $categorieService): Response
    {
        $categorie = $categorieService->getCategorie();


        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'categorie' => $categorie
        ]);
    }
}
