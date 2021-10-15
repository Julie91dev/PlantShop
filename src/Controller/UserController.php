<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\CommandeRepository;
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
     * @return PdfResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/profile/facture", name="profile_facturePDF")
     */
    public function facturesPDFAction($id, CommandeRepository $commandeRepository, Pdf $pdf)
    {
        $facture = $commandeRepository->findOneBy(array('utilisateur' => $this->getUser(),
            'valider' => 1,
            'id' => $id));

        dump($facture);
        die();

        if (!$facture) {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            //return $this->redirect($this->generateUrl('facutres'));
            return $this->redirectToRoute("profile_facture");
        }

        $html = $this->renderView('user/commande/facturePDF.html.twig', ['facture' => $facture]);
/*
        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetAuthor('DevAndClick');
        $html2pdf->pdf->SetTitle('Facture '.$facture->getReference());
        $html2pdf->pdf->SetSubject('Facture DevAndClick');
        $html2pdf->pdf->SetKeywords('facture,devandclick');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->Output('Facture.pdf');*/

        /*$response = new Response();
        $response->headers->set('Content-type' , 'application/pdf');*/

        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            'facture-'.$facture->getId().'.pdf'
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
}
