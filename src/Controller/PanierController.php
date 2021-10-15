<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\AdresseRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommandeRepository;
use App\Service\Categorie\CategorieService;
use App\Service\Panier\PanierService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{


    /**
     * @Route("/panier", name="panier")
     */
    public function index(PanierService $panierService, CategorieService $categorieService): Response
    {
        $categorie = $categorieService->getCategorie();

       /* $panier = $session->get('panier', []);
        $panierAvecData = [];
        $total= 0;

        foreach ($panier as $id => $quantite){

            $produit =  $articleRepository->find($id);
            $panierAvecData[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
            $totalItem = $produit->getPrix() * $quantite;
            $total += $totalItem;
          //  dd($panierAvecData);

        }*/

       // $session->set('panier', $panierAvecData);
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
    public function add(int $id, PanierService $panierService): Response
    {

       /* $panier= $session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);*/
        $panierService->addPanier($id);

        return $this->redirectToRoute('panier');
    }

    /**
     * Supprimer un produit du panier
     * @param int $id
     * @Route ("/panier/delete/{id}", name="panier_delete")
     */
    public function delete(int $id, PanierService $panierService)
    {


   /*     $panier = $session->get('panier', []);

        if (!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);*/
        $panierService->deleteProduitPanier($id);
        return $this->redirectToRoute("panier");
    }

    /**
     * Enleve une quantite d'un produit
     * @param int $id
     * @Route ("/panier/remove/{id}", name="panier_remove")
     */
    public function remove(int $id,PanierService $panierService)
    {


        /*$panier = $session->get('panier', []);

        if (!empty($panier[$id])){
            if ($panier[$id] > 1){
                $panier[$id]--;
            }else {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);*/
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
     * Choix de la livraison en Session
     * @Route("/panier/livraison/setLivraison", name="panier_set_livraison")
     */
    public function setLivraisonOnSession(Request $request, SessionInterface $session)
    {
        /*if (!$session->has('adresse')){
            $session->set('adresse', []);

        }
        $adresse = $session->get('adresse');

        if ($request->get('livraison') != null && $request->get('facturation') != null ){

            $adresse['livraison'] = $request->get('livraison');
            $adresse['facturation'] = $request->get('facturation');


        }else{
            return $this->redirectToRoute("panier_livraison");
        }

        $session->set('adresse', $adresse);
        return $this->redirectToRoute("panier_validation");*/
    }

    /**
     * Valider le panier
     * @Route ("/panier/validation", name="panier_validation")
     */
    public function validerPanier(CategorieService $categorieService,
                                  PanierService $panierService,
                                  Request $request)
    {

        $categorie = $categorieService->getCategorie();
        /*$client = $this->getUser()->getId();
        if ($request->getMethod() == 'POST') {
            $this->setLivraisonOnSession($request, $session);
        }
        $prepareCommande = $commandeController->prepareCommande($session, $commandeRepository, $entityManager, $adresseRepository, $articleRepository);
        $commande = $commandeRepository->find($prepareCommande->getContent());*/
      /*  $adresse = $session->get('adresse');


        $livraisonId= $adresse['livraison'];
        $facturationId= $adresse['facturation'];

        $panier= $session->get('panier', []);
        $livraison = $adresseRepository->find($livraisonId);
        $facturation = $adresseRepository->find($facturationId);




        $panierAvecData = [];
        $total= 0;

        foreach ($panier as $id => $quantite) {
            $produit = $articleRepository->find($id);
            dump("produit");
            dump($produit);
            $panierAvecData[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
            $totalItem = $produit->getPrix() * $quantite;
            $total += $totalItem;

        }*/
        $commande = $panierService->validerPanier($request);

        return $this->render('panier/validerPanier.html.twig', [
            'controller_name' => 'PanierController',
            'categorie' => $categorie,
            'commande' => $commande
            /*'panier' => $panier,
            'livraison' => $livraison,
            'facturation' => $facturation,
            'items' => $panierAvecData,
            'total' => $total*/
        ]);
    }
}






