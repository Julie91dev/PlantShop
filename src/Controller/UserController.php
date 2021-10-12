<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categoriePlante = $categorieRepository->find(1);
        $categorieDecoration = $categorieRepository->find(2);
        $categorieOutil = $categorieRepository->find(3);

        return $this->render('user/profile.html.twig', [
            'controller_name' => 'UserController',
            'plante' => $categoriePlante,
            'decoration' => $categorieDecoration,
            'outil' => $categorieOutil
        ]);
    }
}
