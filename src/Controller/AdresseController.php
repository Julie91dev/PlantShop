<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdresseController extends AbstractController
{
    /**
     * @Route("/profile/adresse", name="adresse_list")
     */
    public function list(CategorieRepository $categorieRepository, AdresseRepository $adresseRepository): Response
    {

        $categoriePlante = $categorieRepository->find(1);
        $categorieDecoration = $categorieRepository->find(2);
        $categorieOutil = $categorieRepository->find(3);

        $client = $this->getUser()->getId();

        $adresses = $adresseRepository->findBy(['client' => $client]);

        return $this->render('user/adresse/list.html.twig', [
            'controller_name' => 'AdresseController',
            'plante' => $categoriePlante,
            'decoration' => $categorieDecoration,
            'outil' => $categorieOutil,
            'adresses' => $adresses
        ]);
    }

    /**
     * @Route("/profile/adresse/add", name="adresse_add")
     */
    public function add(Request $request, CategorieRepository $categorieRepository, EntityManagerInterface  $entityManager): Response
    {

        $categoriePlante = $categorieRepository->find(1);
        $categorieDecoration = $categorieRepository->find(2);
        $categorieOutil = $categorieRepository->find(3);

        $adresse = new Adresse();
        $adresse->setClient($this->getUser());

        $adresseForm = $this->createForm(AdresseType::class, $adresse);

        $adresseForm->handleRequest($request);

        if ($adresseForm->isSubmitted() && $adresseForm->isValid()){
            $entityManager->persist($adresse);
            $entityManager->flush();

            $this->addFlash('success', 'Adresse enregistrée');

            return $this->redirectToRoute('adresse_list');
        }


        return $this->render('user/adresse/add.html.twig', [
            'controller_name' => 'AdresseController',
            'adresseForm' => $adresseForm->createView(),
            'plante' => $categoriePlante,
            'decoration' => $categorieDecoration,
            'outil' => $categorieOutil,
        ]);
    }
}
