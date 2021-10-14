<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

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
            'plante' => $categoriePlante,
            'decoration' => $categorieDecoration,
            'outil' => $categorieOutil,
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
