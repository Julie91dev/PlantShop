<?php

namespace App\Controller;

use App\Service\Categorie\CategorieService;
use App\Service\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{


    /**
     * Affichage du panier
     * @Route("/panier", name="panier")
     */
    public function index(PanierService $panierService,
                          CategorieService $categorieService): Response
    {
        $categorie = $categorieService->getCategorie();

        $panierAvecData = $panierService->getPanier();
        $total = $panierService->getTotalPanier();

        return $this->render('panier/panier.html.twig', [
            'controller_name' => 'PanierController',
            'items'=> $panierAvecData,
            'total' => $total,
            'categorie' => $categorie
        ]);
    }

    /**
     * Ajouter un produit au panier
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add(int $id,
                        PanierService $panierService): Response
    {

        $panierService->addPanier($id);

        return $this->redirectToRoute('panier');
    }

    /**
     * Supprimer un produit du panier
     * @param int $id
     * @Route ("/panier/delete/{id}", name="panier_delete")
     */
    public function delete(int $id,  PanierService $panierService)
    {

        $panierService->deleteProduitPanier($id);
        return $this->redirectToRoute("panier");
    }

    /**
     * Enleve une quantite d'un produit du panier
     * @param int $id
     * @Route ("/panier/remove/{id}", name="panier_remove")
     */
    public function remove(int $id, PanierService $panierService)
    {
        $panierService->removeQuantityPanier($id);

        return $this->redirectToRoute("panier");
    }

    /**
     * Supprimer tout le panier
     * @Route ("/panier/delete", name="panier_delete_all")
     */
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("panier");
    }

    /**
     * Validation panier, redirection vers la page livraison
     * @Route ("/panier/livraison", name="panier_livraison")
     */
    public function livraison(CategorieService $categorieService, PanierService $panierService)
    {
        $categorie = $categorieService->getCategorie();

        if (!empty($this->getUser())){

            $adressesLivraison = $panierService->livraison();


            return $this->render('panier/livraison.html.twig', [
                'controller_name' => 'PanierController',
                'categorie' => $categorie,
                'adresse' => $adressesLivraison['adresse'],
                'adresses' => $adressesLivraison['adresses'],
                'derniereAdresse' => $adressesLivraison['derniereAdresse']
            ]);
        }else {
            $this->addFlash('error', 'Veuillez vous connecter avant de valider votre panier');
            return $this->redirectToRoute("app_login");
        }


    }

    /**
     * Valider le panier
     * @Route ("/panier/validation", name="panier_validation")
     */
    public function validerPanier(CategorieService $categorieService, PanierService $panierService, Request $request)
    {

        $categorie = $categorieService->getCategorie();

        $commande = $panierService->validerPanier($request);

        return $this->render('panier/validerPanier.html.twig', [
            'controller_name' => 'PanierController',
            'categorie' => $categorie,
            'commande' => $commande

        ]);
    }
}






