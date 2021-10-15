<?php

namespace App\Controller;

use App\Repository\AdresseRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommandeRepository;
use App\Service\Adresse\AdresseService;
use App\Service\Categorie\CategorieService;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
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

    /**
     * @Route("/profile/commande", name="profile_commande_historique")
     */
    public function listCommande(CategorieService $categorieService, CommandeRepository $commandeRepository): Response
    {
        $categorie = $categorieService->getCategorie();

        $commandes = $commandeRepository->findBy(['client' => $this->getUser()]);

        return $this->render('user/profile/commande.html.twig', [
            'controller_name' => 'UserController',
            'categorie' => $categorie,
            'commande' => $commandes
        ]);
    }

    /**
     * @return Response
     * @Route("/profile/facture", name="profile_facture")
     */
    public function factures(CategorieService $categorieService, CommandeRepository $commandeRepository)
    {
        $categorie = $categorieService->getCategorie();
        $factures = $commandeRepository->byFacture($this->getUser());

        return $this->render('user/commande/facture.html.twig', [
            'controller_name' => 'UserController',
            'factures' => $factures,
            'categorie' => $categorie
        ]);
    }

    /**
     * @param $id
     * @param CommandeRepository $commandeRepository
     * @param Pdf $pdf
     * @Route("/profile/facture", name="profile_facturePDF")
     */
    public function facturesPDFAction($id, CommandeRepository $commandeRepository,Pdf $pdf)
    {
        $facture = $commandeRepository->findOneBy(array('utilisateur' => $this->getUser(),
            'valider' => 1,
            'id' => $id));


        if (!$facture) {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirectToRoute("profile_facture");
        }

        $html = $this->renderView('user/commande/facturePDF.html.twig', ['facture' => $facture]);
        $filename = $facture->getReference();

        return new Response(
            $pdf->getOutputFromHtml($html),
            200,
            [
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            ]
        );


    }

    /**
     * @Route("/test/{id}", name="test")
     */
    public function testPdf($id, CommandeRepository $commandeRepository,Pdf $snappy){

       // $snappy = $this->get('knp_snappy.pdf');
        $facture = $commandeRepository->findOneBy(array('client' => $this->getUser(),
            'valider' => 1,
            'id' => $id));

        $html = $this->renderView('user/commande/facturePDF.html.twig', ['facture' => $facture]);

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            [
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            ]
        );
    }

    /**
     * @Route("/profile/monprofil", name="profile_monprofil")
     */
    public function info(CategorieService $categorieService, AdresseRepository $adresseRepository): Response
    {
        $idClient = $this->getUser()->getId();
        $categorie = $categorieService->getCategorie();
        $adresse = $adresseRepository->findLastAdress($idClient);

        return $this->render('user/profile/profil.html.twig', [
            'controller_name' => 'UserController',
            'categorie' => $categorie,
            'adresse' => $adresse
        ]);
    }
}
