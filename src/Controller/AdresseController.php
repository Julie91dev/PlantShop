<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdresseController extends AbstractController
{
    /**
     * @Route("/profile/adresse", name="adresse_list")
     */
    public function list(CategorieRepository $categorieRepository): Response
    {

        $categoriePlante = $categorieRepository->find(1);
        $categorieDecoration = $categorieRepository->find(2);
        $categorieOutil = $categorieRepository->find(3);

        return $this->render('user/adresse/list.html.twig', [
            'controller_name' => 'AdresseController',
            'plante' => $categoriePlante,
            'decoration' => $categorieDecoration,
            'outil' => $categorieOutil,
        ]);
    }

    /**
     * @Route("/profile/adresse/add", name="adresse_add")
     */
    public function add(CategorieRepository $categorieRepository): Response
    {

        $categoriePlante = $categorieRepository->find(1);
        $categorieDecoration = $categorieRepository->find(2);
        $categorieOutil = $categorieRepository->find(3);

        $adresse = new Adresse();
        $adresseForm = $this->createForm(AdresseType::class, $adresse);
        //TODO traiter le formulaire
        return $this->render('user/adresse/add.html.twig', [
            'controller_name' => 'AdresseController',
            'adresseForm' => $adresseForm->createView(),
            'plante' => $categoriePlante,
            'decoration' => $categorieDecoration,
            'outil' => $categorieOutil,
        ]);
    }
}
