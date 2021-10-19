<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use App\Service\Adresse\AdresseService;
use App\Service\Categorie\CategorieService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AdresseController extends AbstractController
{
    /**
     * @Route("/profile/adresse", name="adresse_list")
     */
    public function list(CategorieService $categorieService, AdresseService $adresseService): Response
    {

        $categorie = $categorieService->getCategorie();

        $adresses = $adresseService->getAllAdresseByClient();

        return $this->render('user/adresse/list.html.twig', [
            'controller_name' => 'AdresseController',
            'categorie' => $categorie,
            'adresses' => $adresses
        ]);
    }

    /**
     * @Route("/profile/adresse/add", name="adresse_add")
     */
    public function add(Request $request, CategorieService $categorieService, EntityManagerInterface  $entityManager): Response
    {

        $categorie = $categorieService->getCategorie();

        $adresse = new Adresse();
        $adresse->setClient($this->getUser());
        $adresse->setDateCreation(new \DateTime());

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
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/profile/adresse/delete", name="adresse_delete")
     */
    public function delete(Request $request, CategorieService $categorieService, EntityManagerInterface  $entityManager, AdresseRepository $adresseRepository): Response
    {
        $result = false;
        if ($request->isXmlHttpRequest()){
            $postData = json_decode($request->getContent());
            $idAdresse = $postData->idAdresse;
            $adresse = $adresseRepository->find($idAdresse);
            $entityManager->remove($adresse);
            $entityManager->flush();

            return new Response("ok");
        }
        return new Response("not ok");


    }


    /**
     * @Route("/profile/adresse/update/{id}", name="adresse_update")
     */
    public function update(Adresse $adresse,Request $request, CategorieService $categorieService, EntityManagerInterface  $entityManager, AdresseRepository $adresseRepository): Response
    {
        $categorie = $categorieService->getCategorie();
//        $adresse = $adresseRepository->find($id);
        $adresseForm = $this->createForm(AdresseType::class, $adresse);
        $adresseForm->handleRequest($request);

        if ($adresseForm->isSubmitted() && $adresseForm->isValid()){
            $entityManager->persist($adresse);
            $entityManager->flush();

            $this->addFlash('success', 'Adresse modifiée');
            return $this->redirectToRoute('adresse_list');
        }



        return $this->render('user/adresse/update.html.twig', [
            'controller_name' => 'AdresseController',
            'categorie' => $categorie,
            'adresse' => $adresse,
            'adresseForm' => $adresseForm->createView()
        ]);


    }
    /**
     * @param Request $request
     * @param AdresseRepository $adresseRepository
     * @return JsonResponse|Response
     * @Route("/profile/adresseId", name="adresse_id")
     */
    public function getAdresse(Request $request, AdresseRepository $adresseRepository, NormalizerInterface $normalizable)
    {
        if ($request->isXmlHttpRequest()){
            $postData = json_decode($request->getContent());
            $idAdresse = $postData->idAdresse;
           // $idAdresse = $request->query->get("idAdresse");

           // dd($idAdresse);

            if ($idAdresse) {

                $adresse = $adresseRepository->find($idAdresse);


                if ($adresse) {
                    $normalizable = $normalizable->normalize($adresse, null, ['groups' => 'personne:read']);
                    $json = json_encode($normalizable);
                    return new Response($json, 200, ['content-type' => 'application/json']);
                    //$reponse = ['adresse' => $adresse];
                    //return $serializer->serialize($adresse, 'json');
                    //return $this->json($reponse);
                }else {
                    return new Response("Il n'y a pas d'adresse");
                }
            } else {
                return new Response("Il n'y a pas d'id adresse");
            }
        }else {
            return new Response("Ce n'est pas une requête ajax");
        }

    }
}
