<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    public function __construct()
    {

    }

    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $session, ArticleRepository $articleRepository, CategorieRepository $categorieRepository): Response
    {
        $categoriePlante = $categorieRepository->find(1);
        $categorieDecoration = $categorieRepository->find(2);
        $categorieOutil = $categorieRepository->find(3);

        $panier = $session->get('panier', []);
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
        }

        return $this->render('panier/panier.html.twig', [
            'controller_name' => 'PanierController',
            'items'=> $panierAvecData,
            'total' => $total,
            'plante' => $categoriePlante,
            'decoration' => $categorieDecoration,
            'outil' => $categorieOutil,
        ]);
    }

    /**
     * Ajouter un produit au panier
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add(int $id, SessionInterface $session): Response
    {

        $panier= $session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');
    }

    /**
     * Supprimer un produit du panier
     * @param int $id
     * @Route ("/panier/delete/{id}", name="panier_delete")
     */
    public function delete(int $id, SessionInterface $session)
    {


        $panier = $session->get('panier', []);

        if (!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("panier");
    }

    /**
     * Enleve une quantite d'un produit
     * @param int $id
     * @Route ("/panier/remove/{id}", name="panier_remove")
     */
    public function remove(int $id, SessionInterface $session)
    {


        $panier = $session->get('panier', []);

        if (!empty($panier[$id])){
            if ($panier[$id] > 1){
                $panier[$id]--;
            }else {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);

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
}




